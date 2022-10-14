<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id'); 
            $table->integer('follower')->unsigned();
            $table->integer('following')->unsigned();
        });

        Schema::table('follows', function($table) {
            $table->foreign('follower')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('following')
                  ->references('id')
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
        Schema::dropIfExists('follows');
    }
}
