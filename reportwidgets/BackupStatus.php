<?php namespace Alxy\Backup\ReportWidgets;

use Alxy\Backup\Models\Settings;
use Backend\Classes\ReportWidgetBase;
use Exception;
use Storage;

class BackupStatus extends ReportWidgetBase
{
    /**
     * Renders the widget.
     */
    public function render()
    {
        try {
            $this->loadData();
        }
        catch (Exception $ex) {
            $this->vars['error'] = $ex->getMessage();
        }

        return $this->makePartial('widget');
    }

    public function defineProperties()
    {
        return [
            'title' => [
                'title'             => 'backend::lang.dashboard.widget_title_label',
                'default'           => 'Backup status',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'backend::lang.dashboard.widget_title_error',
            ],
            'dateFormat' => [
                'title'             => 'Date format',
                'default'           => 'Y-m-d H:i',
                'type'              => 'string',
                'validationPattern' => '^.+$',
                'validationMessage' => 'The date format is required.',
            ]
        ];
    }

    protected function loadData()
    {
        $this->vars['enabled'] = Settings::get('scheduled_backup', false);

        $files = Storage::files(config('laravel-backup.destination.path'));
        if($files && $last = array_pop($files)) {
            $fileinfo = pathinfo($last);
            $date = ($fileinfo['extension'] == 'zip') ? date_create_from_format('YmdHis', $fileinfo['filename']) : false;
        }
        $this->vars['lastBackup'] = $date;
    }
}
