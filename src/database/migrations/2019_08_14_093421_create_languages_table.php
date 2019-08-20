<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->index();
            $table->boolean('active')->default(true);
            $table->boolean('default')->default(false);
            $table->timestamps();
        });

        DB::table('languages')->insert([
            'name' => 'English',
            'code' => 'en'
        ]);
        DB::table('languages')->insert([
            'name' => 'Spanish',
            'code' => 'es',
            'default' => true
        ]);
        DB::table('languages')->insert([
            'name' => 'Catalan',
            'code' => 'ca'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
