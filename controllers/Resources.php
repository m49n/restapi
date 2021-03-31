<?php

namespace JosephCrowell\RestApi\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use JosephCrowell\RestApi\Classes\ApiGenerator;

class Resources extends Controller
{
    public $implement = ['Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = ['josephcrowell.restapi.manage_apis'];

    /**
     * @var ApiGenerator
     */
    private $apiGenerator;

    public function __construct(ApiGenerator $apiGenerator)
    {
        parent::__construct();
        BackendMenu::setContext('josephcrowell.restapi', 'rest-api-main', 'rest-api-resources');

        $this->apiGenerator = $apiGenerator;
    }
}
