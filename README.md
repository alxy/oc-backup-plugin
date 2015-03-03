# oc-backup-plugin
Backup your October app in seconds.
This plugin adds [spatie/laravel-backup](https://github.com/freekmurze/laravel-backup) package to October for simple backup functionalities.

## Installation
* `git clone` into */plugins/alxy/backup*
* `composer install --no-dev`
* `php artisan backup:run`

## Configuration
* This plugin automatically publishes its config file to */config/laravel-backup.php*. Please read this file carefully and change the options to fit your needs.
* This plugin also adds the ability to run the backup command frequently. Go to *Settings > System > Backup Setting* to enable and configure the scheduled command.

## Report widget
* This plugin also comes with a basic report widget to observe the status of the backups. Feel free to add it to your dashboard.
