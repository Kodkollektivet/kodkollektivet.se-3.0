<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('event_users', function($table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('event_id')
                  ->references('id')
                  ->on('events')
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
        Schema::dropIfExists('event_users');
    }
}
