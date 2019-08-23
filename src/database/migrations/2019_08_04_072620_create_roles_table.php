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
        Schema::create('endo_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->integer('level')->unsigned()->default(0);
            $table->timestamps();
        });

        DB::table('endo_roles')->insert(['name' => 'admin', 'level' => 99]);
        DB::table('endo_roles')->insert(['name' => 'subadmin', 'level' => 90]);
        DB::table('endo_roles')->insert(['name' => 'editor', 'level' => 2]);
        DB::table('endo_roles')->insert(['name' => 'user', 'level' => 1]);
        DB::table('endo_roles')->insert(['name' => 'guest', 'level' => 0]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('endo_roles');
    }
}
