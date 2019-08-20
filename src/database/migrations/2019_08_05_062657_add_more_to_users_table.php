<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('users') ) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
            });
        }

        if (Schema::hasTable('users') ) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('lastname')->nullable()->after('name');
                $table->string('avatar')->nullable()->default('user-endo.jpg')->after('password');
                $table->integer('role_id')->unsigned()->nullable()->after('id');

                $table->foreign('role_id')->references('id')->on('roles')
                    ->onDelete('SET NULL');
            });
        }

        $role = DB::table('roles')->where('name', 'admin')->first();

        DB::table('users')->insert([
            'name' => 'suport',
            'lastname' => '6TEMS',
            'email' => 'pol@6tems.com',
            'password' => '$2y$10$/naWT4.gfnmgy2sVRAgp/uX0pysltaMvOjn9zxjka8FcnHGwNNA0m',
            'role' => $role->id,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'lastname')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('lastname');
                $table->dropColumn('avatar');
            });
        }
    }
}
