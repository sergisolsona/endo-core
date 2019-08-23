<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endo_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('endo_post_type_id')->unsigned()->nullable();
            $table->smallInteger('status')->default(1);
            $table->string('template')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('endo_post_type_id')->references('id')->on('endo_post_types')
                ->onDelete('SET NULL');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('SET NULL');

            $table->foreign('parent_id')->references('id')->on('endo_posts')
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
        Schema::dropIfExists('endo_posts');
    }
}
