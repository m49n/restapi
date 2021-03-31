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
            'name' => 'RESTful API Generator',
            'description' => 'Generate RESTful APIs from your models',
            'author' => 'Joseph Crowell',
            'icon' => 'icon-exchange'
        ];
    }

    public function register()
    {
        $this->registerConsoleCommand('restapi:routes:sync', SyncRoutesCommand::class);
    }
}