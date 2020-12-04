# FileSharingOnCdn

Plugin for OctoberCMS

## Install

* OctoberCMS full installed in ${PATH_TO_PROJECT}
* Create directory ${PATH_TO_PROJECT}/plugins/observatby
* Go to the created directory
* `git clone https://github.com/Observat/FileSharingOnCdn`
* Rename from FileSharingOnCdn to filesharingoncdn
* Parameters from ${PATH_TO_PROJECT}/plugins/observatby/.env.example add into ${PATH_TO_PROJECT}/.env
* May be run `chown -R www-data:www-data ...`
* Go to the ${PATH_TO_PROJECT}
* `composer update`
* `php artisan october:up` or `php artisan plugin:refresh Observatby.FileSharingOnCdn`.
 Command `plugin:refresh` recreate database tables of this plugin with truncating data!
* Add Cron entry: `* * * * * php ${PATH_TO_PROJECT} schedule:run >> /dev/null 2>&1`.
  Can use `0 */1 * * * php ${PATH_TO_PROJECT} schedule:run >> /dev/null 2>&1`

## Update

* Go to the ${PATH_TO_PROJECT}/plugins/observatby/filesharingoncdn
* `git pull`
* Go to the ${PATH_TO_PROJECT}
* `composer update`
* `php artisan october:up`
