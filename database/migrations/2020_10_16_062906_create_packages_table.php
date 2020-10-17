<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('title');
            $table->string('image')->default('placeholder.jpg');
            $table->double('rate');
            $table->integer('nights')->nullable();
            $table->integer('days')->nullable();
            $table->integer('minPax');
            $table->string('tag');
            $table->string('status');
            $table->string('hotel');
            $table->string('trans');
            $table->string('meal');
            $table->string('sight');
            $table->text('description');
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
        Schema::dropIfExists('packages');
    }
}
