<?php namespace Alxy\Backup\Updates;

use Artisan;
use Exception;
use October\Rain\Database\Updates\Seeder;

class PublishConfig extends Seeder
{
    public function run()
    {
        try {
            Artisan::call('vendor:publish --provider="Alxy\Backup\Plugin"');
        } catch (Exception $e) {}
    }
}