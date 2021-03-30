<?php

namespace JosephCrowell\OcRestApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use JosephCrowell\OcRestApi\Classes\ApiGenerator;

class Resources extends Controller
{
    public $implement = ['Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['josephcrowell.ocrestapi.manage_apis'];

    /**
     * @var ApiGenerator
     */
    private $apiGenerator;

    public function __construct(ApiGenerator $apiGenerator)
    {
        parent::__construct();
        BackendMenu::setContext('josephcrowell.ocrestapi', 'ocrest-api-main', 'ocrest-api-resources');

        $this->apiGenerator = $apiGenerator;
    }
}