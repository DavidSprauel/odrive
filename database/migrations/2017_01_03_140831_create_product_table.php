<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type', false, true);
            $table->string('name', 255);
            $table->integer('weight', false, true);
            $table->string('units', 2);
            $table->float('price', 8, 2);
            $table->string('origin', 255)->nullable();
            $table->string('reference', 255)->nullable();
            $table->tinyInteger('taxes', false, true)->default(1);
            $table->string('picture', 255)->nullable();
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
        Schema::dropIfExists('products');
    }
}
