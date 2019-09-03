<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_post_id')->unsigned();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('post_name')->nullable();
            $table->string('urls_post_name')->nullable();
            $table->integer('endo_media_id')->unsigned()->nullable();
            $table->string('locale')->nullable()->index();
            $table->timestamps();

            $table->unique(['endo_post_id', 'locale']);
            $table->foreign('endo_post_id')->references('id')->on('endo_posts')->onDelete('cascade');

            $table->foreign('endo_media_id')->references('id')->on('endo_medias')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_post_translations');
    }
}
