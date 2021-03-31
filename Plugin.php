<?php

namespace JosephCrowell\RestApi;

use JosephCrowell\RestApi\Console\SyncRoutesCommand;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['RLuders.JWTAuth'];

    public function pluginDetails()
    {
        return [
            'name' => 'josephcrowell.restapi::lang.plugin.name',
            'description' => 'josephcrowell.restapi::lang.plugin.description',
            'author' => 'Joseph Crowell',
            'icon' => 'icon-exchange'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('restapi:routes:sync', SyncRoutesCommand::class);
    }
}