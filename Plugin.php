<?php namespace Alxy\Backup;

use App;
use Alxy\Backup\Models\Settings;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;

/**
 * Backup Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Backup',
            'description' => 'Backup your October app in seconds.',
            'author'      => 'Alxy',
            'icon'        => 'icon-file-archive-o'
        ];
    }

    public function boot()
    {
        App::register('Spatie\Backup\BackupServiceProvider');

        $this->publishes([
            __DIR__.'/config/laravel-backup.php' => config_path('laravel-backup.php'),
        ]);
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Backup Settings',
                'description' => 'Manage backup settings.',
                'category'    => SettingsManager::CATEGORY_SYSTEM,
                'icon'        => 'icon-file-archive-o',
                'class'       => 'Alxy\Backup\Models\Settings',
                'order'       => 500,
                'keywords'    => 'security backup scheduled zip'
            ]
        ];
    }

    public function registerSchedule($schedule)
    {
        if(Settings::get('scheduled_backup', false)) {
            $frequency = Settings::get('frequency');
            $schedule->command('backup:run')->{$frequency}();
        }
    }

    public function registerReportWidgets()
    {
        return [
            'Alxy\Backup\ReportWidgets\BackupStatus' => [
                'label'   => 'Backup status',
                'context' => 'dashboard'
            ]
        ];
    }

}
