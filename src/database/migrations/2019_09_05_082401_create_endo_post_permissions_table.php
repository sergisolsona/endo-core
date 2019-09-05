<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndoPostPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_post_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_role_id')->unsigned();
            $table->integer('endo_post_type_id')->unsigned();
            $table->boolean('create');
            $table->boolean('read');
            $table->boolean('update');
            $table->boolean('delete');
            $table->boolean('publish');
            $table->timestamps();

            $table->unique(['endo_role_id', 'endo_post_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_post_permissions');
    }
}
