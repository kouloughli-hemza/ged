<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {


            $table->foreign('role_id')
                ->references('ref_role')
                ->on('roles');

            $table->foreign('id_direc')
                ->references('id_direc')
                ->on('directions')
                ->onDelete('cascade');

        });

        Schema::table('social_logins', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('ref_user')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('users_activity', function (Blueprint $table) {
            $table->foreign('ref_user')
                ->references('ref_user')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('api_tokens', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('ref_user')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('ref_user')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() != 'sqlite') {
            Schema::table('users', function (Blueprint $table) {
                //$table->dropForeign('users_country_id_foreign');
                $table->dropForeign('users_role_id_foreign');
            });

            Schema::table('social_logins', function (Blueprint $table) {
                $table->dropForeign('social_logins_user_id_foreign');
            });
        }
    }
}
