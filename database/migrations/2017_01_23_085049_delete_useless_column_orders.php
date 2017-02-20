<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteUselessColumnOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('address');
            $table->dropColumn('city');
            $table->dropColumn('zipcode');
            $table->dropColumn('email');
            $table->dropColumn('phone');
            $table->dropColumn('shipping_address');
            $table->integer('user_id', false, true)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('firstname', 255);
            $table->string('lastname', 255);
            $table->text('address');
            $table->string('city', 200);
            $table->integer('zipcode', false, true);
            $table->string('email', 254);
            $table->string('phone', 15);
            $table->text('shipping_address', 15)->nullable();
            $table->dropColumn('user_id');
        });
    }
}
