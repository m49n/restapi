<?php

namespace JosephCrowell\OcRestApi;

use JosephCrowell\OcRestApi\Console\SyncRoutesCommand;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['RLuders.JWTAuth'];

    public function pluginDetails()
    {
        return [
            'name' => 'josephcrowell.ocrestapi::lang.plugin.name',
            'description' => 'josephcrowell.ocrestapi::lang.plugin.description',
            'author' => 'Joseph Crowell',
            'icon' => 'icon-cloud'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('ocrestapi:routes:sync', SyncRoutesCommand::class);
    }
}