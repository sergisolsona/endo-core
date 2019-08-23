<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndoPostMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_post_metas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_post_id')->unsigned();
            $table->integer('endo_custom_field_id')->unsigned();
            $table->string('locale')->index();
            $table->longText('value_text')->nullable();
            $table->integer('endo_child_post_id')->unsigned()->nullable();
            $table->integer('endo_media_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();

            $table->unique(['endo_post_id', 'endo_custom_field_id', 'locale'], 'endo_post_cf_locale_unique');

            $table->foreign('endo_post_id')->references('id')->on('endo_posts')->onDelete('cascade');
            $table->foreign('endo_custom_field_id')->references('id')->on('endo_custom_fields')
                ->onDelete('cascade');
            $table->foreign('endo_media_id')->references('id')->on('endo_medias')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('endo_post_metas')
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
        Schema::dropIfExists('endo_post_metas');
    }
}
