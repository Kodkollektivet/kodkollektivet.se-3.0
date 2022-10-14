<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id'); 
            $table->integer('user_id')->unsigned();
            
            $table->string('status')->nullable();
            $table->text('about')->nullable();
            $table->string('cover')->nullable();
            $table->string('phone')->nullable();
            $table->string('discord')->nullable();
            $table->string('github')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('website')->nullable();
            $table->string('campus')->nullable();
            $table->string('programme')->nullable();
            $table->string('LOE')->nullable();
            $table->string('year')->nullable();
            $table->dateTime('date_started')->nullable();
            $table->dateTime('date_ended')->nullable();

            $table->timestamps();
        });

        Schema::table('user_profiles', function($table) {
            $table->foreign('user_id')
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
        Schema::dropIfExists('user_profiles');
    }
}
