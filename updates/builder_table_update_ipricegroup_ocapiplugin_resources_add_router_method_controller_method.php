<?php

namespace JosephCrowell\OcRestApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateIpricegroupOcapipluginResourcesAddRouterMethodControllerMethod extends Migration
{
    const TABLE_NAME = 'josephcrowell_ocrestapi_resources';

    public function up()
    {
        Schema::table(self::TABLE_NAME, function ($table) {
            $table->string('router_method', 20)->default('apiResource');
            $table->string('controller_method', 50)->nullable();
        });
    }

    public function down()
    {
        Schema::table(self::TABLE_NAME, function ($table) {
            $table->dropColumn('router_method');
            $table->dropColumn('controller_method');
        });
    }
}
