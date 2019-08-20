<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('level')->unsigned()->default(0);
            $table->timestamps();
        });

        DB::table('roles')->insert(['name' => 'admin', 'level' => 99]);
        DB::table('roles')->insert(['name' => 'subadmin', 'level' => 90]);
        DB::table('roles')->insert(['name' => 'editor', 'level' => 2]);
        DB::table('roles')->insert(['name' => 'user', 'level' => 1]);
        DB::table('roles')->insert(['name' => 'guest', 'level' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
