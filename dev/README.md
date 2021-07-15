# Run Webpos Test automation

## Pre Environment Setup
1. Disable password for sudo user
2. Java (JRE or JDK)
3. Install Node.JS, NPM and Gulp

## Setup Environment
[Magento Setup](http://devdocs.magento.com/guides/v2.1/mtf/mtf_installation.html)

**Setup Cron**
1. From Ubuntu, open app `Startup Applications` app
2. Click `Add`
3. Browse command to `dev/magestore/cron` file

**Backup Magento**
```
bin/magento setup:backup --db
```

**Rollback Database**
```
mysql -uroot -proot -e"DROP DATABASE magento2; CREATE DATABASE magento2 CHARACTER SET utf8;"
mysql -uroot -proot magento2 < var/backups/db.sql
```

## Run Test

**Go To Test Folder**
```
cd dev/tests/functional/
```

**Run Selenium Server**
*Chrome*
```
java -Dwebdriver.chrome.driver=chromedriver -jar selenium-server-standalone-3.4.0.jar
```

*Firefox*
```
java -Dwebdriver.chrome.driver=geckodriver -jar selenium-server-standalone-3.4.0.jar
```

**Generate Code**
```
php utils/generate.php
```

**Run**
```
vendor/bin/phpunit --filter Webpos
```

## Auto Run
Use gulp to run task
```
gulp <taskname>
```

## Performance Improvement

**First Time Run**
```
bin/magento module:enable Magestore_Webpos
bin/magento setup:upgrade
bin/magento deploy:mode:set production
```

**Clean Cache**
```
bin/magento cache:clean config layout block_html full_page
```

**Later**
```
bin/magento setup:di:compile
bin/magento setup:static-content:deploy
```
