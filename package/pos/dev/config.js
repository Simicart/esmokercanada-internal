'use strict';

/**
 * Config Test
 */

module.exports = {
    test: "Webpos",
    reset: true,
    database: "/var/lib/",
    backups: "/var/www/html/backups/",
    browsers: {
        // firefox: {
        //     selenium: "java -jar selenium-server-standalone-2.53.1.jar",
        //     stop: "killall java",
        // },
        chrome: {
            selenium: "java -jar selenium-server-standalone-2.53.1.jar",
            stop: "killall java",
        },
        // ie: {
        //     selenium: 'VBoxManage startvm "IE11 - Win7"; sleep 30',
        //     stop: 'VBoxManage controlvm "IE11 - Win7" savestate',
        // },
        // safari: {
        //     selenium: "java -jar selenium-server-standalone-2.53.1.jar",
        //     stop: "killall java",
        // },
    },
    slack: {
        url: "https://hooks.slack.com/services/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",
        payload: {
          channel: "#webpos-project",
          username: "WebPOS Automation BOT",
        },
        text: "Please go to <https://drive.google.com/drive/folders/0B9L3KZLNpxxZNkJ6TmFvSlJ5akk?usp=sharing|Logs> to see more details.",
    },
    log: "cd tests/functional/var; grive",
    validate: {
        enable: true,
        validator: [
            'https://raw.githubusercontent.com/magento/marketplace-tools/master/validate_m2_package.php',
        ],
    },
}
