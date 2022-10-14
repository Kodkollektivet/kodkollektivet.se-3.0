<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            
            $table->string('name');
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->boolean('feature')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_media');
    }
}
