<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndoPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_role_id')->unsigned();
            $table->string('route_name');
            $table->timestamps();

            $table->unique(['endo_role_id', 'route_name']);

            $table->foreign('endo_role_id')->references('id')->on('endo_roles')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_permissions');
    }
}
