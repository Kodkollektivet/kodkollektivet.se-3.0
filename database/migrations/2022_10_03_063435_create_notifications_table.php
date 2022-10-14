<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id'); 
            $table->integer('user_id')->unsigned();
            $table->integer('action_id')->unsigned();
            $table->boolean('viewed')->nullable();

            $table->timestamps();
        });

        Schema::table('notifications', function($table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('action_id')
                  ->references('id')
                  ->on('user_actions')
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
        Schema::dropIfExists('notifications');
    }
}
