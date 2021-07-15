var gulp = require('gulp'),
  replace = require('gulp-batch-replace'),
  rename = require('gulp-rename'),
  concat = require('gulp-concat'),
  wrap = require('gulp-wrap'),
  gulpif = require('gulp-if'),
  uglify = require('gulp-uglify'),
  watch = require('gulp-watch'),
  livereload = require('gulp-livereload'),
  download = require('gulp-download'),
  sourcemaps = require('gulp-sourcemaps'),
  autoprefixer = require('gulp-autoprefixer'),
  cssnano = require('gulp-cssnano'),
  newer = require('gulp-newer'),
  zip = require('gulp-zip'),
  fileinclude = require('gulp-file-include'),
  runSequence = require('run-sequence'),
  exec = require('child_process').exec,
  execSync = require('child_process').execSync,
  path = require('path'),
  gexec = require('gulp-exec'),
  tap = require('gulp-tap'),
  fs = require('fs'),
  del = require('del'),
  config = require('./config.js');

gulp.task('diagram', function(cb) {
  return gulp.src('features/**/*.mmd')
    .pipe(tap(function(file) {
      exec('node_modules/.bin/mermaid -p "' + file.path + '" -o "' + path.dirname(file.path) + '"');
    }));
});

/**
 * *****************************************************************************
 * *************************** RUN TEST AUTOMATION *****************************
 * *****************************************************************************
 */

// Setup Env
gulp.task('setup:githook', function(cb) {
    return exec('ln -s ../../dev/magestore/post-merge ../.git/hooks/post-merge', function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        console.log(err);
        cb();
    });
});

// gulp.task('setup:cron', function(cb) {
//     return exec('./magestore/setup-cron', function (err, stdout, stderr) {
//         console.log(stdout);
//         console.log(stderr);
//         console.log(err);
//         cb();
//     });
// });

gulp.task('setup:database', function(cb) {
    var cmd = 'sudo rm -Rf ' + config.backups + 'mysql;';
    cmd += 'sudo cp -Rf ' + config.database + 'mysql ' + config.backups;
    return exec(cmd, function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        console.log(err);
        cb();
    });
});

gulp.task('setup', ['setup:githook', 'setup:database'], function() {
    console.log('Complete Setup');
});

// Run Test
gulp.task('prepare:database', function(cb) {
    var cmd = 'sudo service mysql stop;';
    cmd += 'sudo rm -Rf ' + config.database + 'mysql;';
    cmd += 'sudo cp -Rf ' + config.backups + 'mysql ' + config.database + ';';
    cmd += 'sudo chown -Rf mysql:mysql ' + config.database + 'mysql;';
    cmd += 'sudo service mysql start;';
    return exec(cmd, function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        console.log(err);
        cb();
    });
});

function getRollbackMysqlCmd() {
    var sqlCmd = 'sudo service mysql stop;';
    sqlCmd += 'sudo rm -Rf ' + config.database + 'mysql;';
    sqlCmd += 'sudo cp -Rf ' + config.backups + 'mysql ' + config.database + ';';
    sqlCmd += 'sudo chown -Rf mysql:mysql ' + config.database + 'mysql;';
    sqlCmd += 'sudo service mysql start;';
    return sqlCmd;
}

function sendSlack(msg) {
    var payload = config.slack.payload;
    payload.text = msg;
    var cmd = "curl -X POST --data-urlencode 'payload=" + JSON.stringify(payload);
    cmd    += "' " + config.slack.url;
    execSync(cmd);
}

// Validate Extension Package
function validatePackage()
{
    if (true !== config.validate.enable) {
        return;
    }
    var result = '';
    // Package Module
    execSync('cd ../app/code/Magestore/Webpos;zip -r ../../../../dev/Webpos.zip .');
    // Run Validate
    for (var i = 0; i < config.validate.validator.length; i++) {
        var url = config.validate.validator[i];
        // Download validator
        execSync('curl -o validator ' + url + '; chmod +x validator');
        // Run validate
        var validResult = execSync('./validator Webpos.zip > tmp 2>&1; cat tmp');
        result += ("string" === typeof validResult) ? validResult : validResult.toString();
        execSync('rm validator;rm tmp');
    }
    execSync('rm Webpos.zip');
    // Send result to slack
    if ('' === result.trim()) {
        result = 'Package is validated!';
    }
    sendSlack("Validate Package Result:\n" + result);
}

gulp.task('validate:package', function(cb) {
    validatePackage();
    cb();
});

gulp.task('default', function(cb) {
try {
    for (var browser in config.browsers) {
        var browserConfig = config.browsers[browser];

        // Rollback Database
        if (config.reset) {
            execSync(getRollbackMysqlCmd());
            execSync('../bin/magento setup:upgrade');
        }

        // Copy config
        var cmd = 'cp browsers/' + browser + '.xml tests/functional/etc/config.xml';
        execSync(cmd);

        // Clean Cache
        exec('../bin/magento cache:clean config layout block_html full_page');
        // Clean DI
        exec('rm -Rf ../var/generation/Magestore/Webpos/');
        // Clean Log
        exec('rm -Rf tests/functional/var/log/*');

        // Start Selenium Server
        if (browserConfig.selenium) {
            cmd  = 'cd ' + config.backups + 'selenium;';
            cmd += 'gnome-terminal -x sh -c "' + browserConfig.selenium + ';bash"';
            if ('ie' === browser) {
                cmd = browserConfig.selenium;
            }
            execSync(cmd);
        }

        // Git comment
        var gitComment = execSync('echo "$(date): $(git --git-dir=../.git log --oneline -1 dev-2.0)"');
        if ("string" !== typeof gitComment) {
            gitComment = gitComment.toString();
        }

        // Run tests
        cmd  = 'cd tests/functional/;';
        cmd += 'php utils/generate.php;';
        cmd += 'vendor/bin/phpunit --filter ' + config.test;
        try {
            execSync(cmd);
            sendSlack('[SUCCESS] ' + gitComment);
        } catch (err) {
            var list = execSync('echo "$(ls tests/functional/var/log/magento/Webpos)"');
            list = ('string' !== typeof list) ? list.toString() : list;
            // Send Slack
            sendSlack('[FAIL] ' + gitComment + "\nFailed Cases:\n" + list + "\n" + config.slack.text);
            // Sync log to Google Drive
            exec(config.log);
        }

        // Stop Selenium Server
        if (browserConfig.stop) {
            execSync(browserConfig.stop);
        }
        if (browserConfig.selenium) {
            execSync('killall sh');
        }
    }
    validatePackage();
} catch (err) {
    // Allow to always complete test
}
    cb();
});

// Validate PHP code & fix
gulp.task('phpcs', function(cb) {
    var cmd = 'magestore/phpcs -n -s --standard=PSR2 --encoding=utf-8 --extensions=php,phtml ../app/code/Magestore';
    return exec(cmd, function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        console.log(err);
        cb();
    });
});

gulp.task('phpcbf', function(cb) {
    var cmd = 'magestore/phpcbf -n -s --standard=PSR2 --encoding=utf-8 --extensions=php,phtml ../app/code/Magestore';
    return exec(cmd, function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        console.log(err);
        cb();
    });
});

/**
 * Watch
 */
gulp.task('watch', function() {
  // Generate Diagram
  gulp.watch('features/**/*.mmd')
    .on('change', function(file) {
      exec('node_modules/.bin/mermaid -p "' + file.path + '" -o "' + path.dirname(file.path) + '"');
    });
});
