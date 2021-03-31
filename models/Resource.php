<?php

namespace JosephCrowell\RestApi\Models;

use Model;
use RainLab\Builder\Classes\ComponentHelper;

use JosephCrowell\RestApi\Classes\ResourceObserver;

/**
 * Model
 */
class Resource extends Model
{
    use \October\Rain\Database\Traits\Validation;

    protected $dates = [];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'josephcrowell_restapi_resources';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    protected $jsonable = [
        'eager_load'
    ];

    protected $fillable = [
        'router_method',
        'base_endpoint',
        'controller_method',
        'model_class',
        'eager_load',
        'is_auth_required',
    ];

    public function getModelClassOptions()
    {
        $globalModels = ComponentHelper::instance()->listGlobalModels();

        unset($globalModels[self::class]);

        return $globalModels;
    }

    protected static function boot()
    {
        parent::boot();
        
        self::observe(ResourceObserver::class);
    }
}
