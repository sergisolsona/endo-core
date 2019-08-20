<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('url_name')->unique();
            $table->tinyInteger('show_image')->default(1);
            $table->tinyInteger('show_content')->default(1);
            $table->tinyInteger('show_author')->default(1);
            $table->tinyInteger('show_parent')->default(1);
            $table->tinyInteger('show_published')->default(1);

            $table->timestamps();
        });

        DB::table('post_types')->insert([
            'name' => 'post'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_types');
    }
}
