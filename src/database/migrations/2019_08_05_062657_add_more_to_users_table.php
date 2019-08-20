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
                $table->integer('endo_role_id')->unsigned()->nullable()->after('id');

                $table->foreign('endo_role_id')->references('id')->on('endo_roles')
                    ->onDelete('SET NULL');
            });
        }

        $role = DB::table('endo_roles')->where('name', 'admin')->first();

        DB::table('users')->insert([
            'name' => 'suport',
            'lastname' => '6TEMS',
            'email' => 'pol@6tems.com',
            'password' => '$2y$10$/naWT4.gfnmgy2sVRAgp/uX0pysltaMvOjn9zxjka8FcnHGwNNA0m',
            'endo_role_id' => $role->id,
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
            DB::table('users')->where('email', 'pol@6tems.com')->delete();

            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign('users_endo_role_id_foreign');

                $table->dropColumn('lastname');
                $table->dropColumn('avatar');
                $table->dropColumn('endo_role_id');
            });
        }
    }
}
