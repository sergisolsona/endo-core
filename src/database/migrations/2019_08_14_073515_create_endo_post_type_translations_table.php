<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEndoPostTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_post_type_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_post_type_id')->unsigned();
            $table->string('url_name')->unique()->nullable();
            $table->string('title');
            $table->string('title_plural');
            $table->string('locale')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_post_type_translations');
    }
}
