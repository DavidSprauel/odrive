<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteOdersProductsTable extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::dropIfExists('orders_products');
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
    }
}
