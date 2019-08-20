<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndoPostTypesCustomFieldGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_post_types_custom_field_groups', function (Blueprint $table) {
            $table->integer('endo_post_type_id')->unsigned();
            $table->integer('endo_custom_field_group_id')->unsigned();
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['endo_post_type_id', 'endo_custom_field_group_id'], 'endo_pt_cfg_unique');

            $table->foreign('endo_post_type_id', 'endo_pt_id_fk')->references('id')
                ->on('endo_post_types')->onDelete('cascade');
            $table->foreign('endo_custom_field_group_id', 'endo_cfg_id_fk')->references('id')
                ->on('endo_custom_field_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_post_types_custom_field_groups');
    }
}
