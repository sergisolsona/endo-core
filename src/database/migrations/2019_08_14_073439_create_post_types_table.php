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
        Schema::create('endo_post_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->boolean('translatable')->default(true);
            $table->tinyInteger('show_image')->default(1);
            $table->tinyInteger('show_content')->default(1);
            $table->tinyInteger('show_author')->default(1);
            $table->tinyInteger('show_parent')->default(1);
            $table->tinyInteger('show_published')->default(1);

            $table->timestamps();
        });

        DB::table('endo_post_types')->insert([
            'name' => 'post'
        ]);
        DB::table('endo_post_types')->insert([
            'name' => 'page'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_post_types');
    }
}
