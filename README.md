# FileSharingOnCdn

Plugin for OctoberCMS

## Install

* Create directory ${PATH_TO_PROJECT}/plugins/observatby
* Go to the created directory
* `git clone https://github.com/Observat/FileSharingOnCdn`
* Rename from FileSharingOnCdn to filesharingoncdn
* Parameters from ${PATH_TO_PROJECT}/plugins/observatby/.env.example add into ${PATH_TO_PROJECT}/.env
* May be run `chown -R www-data:www-data ...`
* `composer update`
* `php artisan october:up` or `php artisan plugin:refresh Observatby.FileSharingOnCdn`.
 Command `plugin:refresh` recreate database tables of this plugin with truncating data!

## Update

* Go to the ${PATH_TO_PROJECT}/plugins/observatby/filesharingoncdn
* `git pull`
* Go to the ${PATH_TO_PROJECT}
* `composer update`
* `php artisan october:up`
