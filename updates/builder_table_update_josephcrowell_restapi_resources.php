<?php

namespace JosephCrowell\RestApi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateJosephCrowellRestApiResources extends Migration
{
    const TABLE_NAME = 'josephcrowell_restapi_resources';

    public function up()
    {
        Schema::table(self::TABLE_NAME, function ($table) {
            $table->unique('base_endpoint');
            $table->dropColumn('deleted_at');
        });
    }

    public function down()
    {
        Schema::table(self::TABLE_NAME, function ($table) {
            $table->dropUnique(self::TABLE_NAME . '_base_endpoint_unique');
            $table->timestamp('deleted_at')->nullable();
        });
    }
}