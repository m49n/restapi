<?php

namespace JosephCrowell\RestApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateIpricegroupOcapipluginResources extends Migration
{
    public function up()
    {
        Schema::create('josephcrowell_restapi_resources', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('base_endpoint');
            $table->string('model_class');
            $table->json('eager_load');
            $table->boolean('is_auth_required')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('josephcrowell_restapi_resources');
    }
}
