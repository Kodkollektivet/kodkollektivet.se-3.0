<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';                                    // Add support for
                                                                          // foreign keys.
            $table->increments('id');                                     // Use increments()
            $table->string('name');                                       // for primary
            $table->string('username');
            $table->boolean('company')->default(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification')->nullable();
            $table->integer('role_id')->unsigned()->default(4);           // and integer()
            $table->integer('position_id')->unsigned()->nullable();       // for foreign.
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->string('session_id')->nullable();
            $table->boolean('closed')->default(false);
            $table->boolean('remove_data')->default(false);
            $table->boolean('activity_hide')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        /**
         * "SQLSTATE[HY000]: General error: 1215 Cannot add
         * foreign key constraint" workaround:
         */

        Schema::table('users', function($table) {
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');

            $table->foreign('position_id')
                  ->references('id')
                  ->on('positions')
                  ->onDelete('cascade');
        });

        /**
         * If you are still getting the error, 
         * try changing the order of migrations.
         */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
