<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndoCustomFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_custom_field_group_id')->unsigned();
            $table->string('name');
            $table->string('title');
            $table->string('type');
            $table->string('instructions');
            $table->longText('params');
            $table->integer('order');
            $table->timestamps();

            $table->foreign('endo_custom_field_group_id')->references('id')->on('endo_custom_field_groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_custom_fields');
    }
}
