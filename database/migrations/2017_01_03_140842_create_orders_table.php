<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->text('address');
            $table->string('city', 200);
            $table->integer('zipcode', false, true);
            $table->text('comment')->nullable();
            $table->string('email', 254);
            $table->string('phone', 15);
            $table->text('shipping_address', 15)->nullable();
            $table->tinyInteger('status');
            $table->integer('viewed_by', false, true)->nullable()->default(null);
            $table->dateTime('viewed_at')->nullable()->default(null);
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
        Schema::dropIfExists('orders');
    }
}
