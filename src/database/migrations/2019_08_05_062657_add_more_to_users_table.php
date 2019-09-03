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
                $table->string('avatar')->nullable()->default('6tems.png')->after('password');
                $table->integer('endo_role_id')->unsigned()->nullable()->after('id');

                $table->foreign('endo_role_id')->references('id')->on('endo_roles')
                    ->onDelete('SET NULL');
            });
        }
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
                $table->dropForeign('users_endo_role_id_foreign');

                $table->dropColumn('lastname');
                $table->dropColumn('avatar');
                $table->dropColumn('endo_role_id');
            });
        }
    }
}
