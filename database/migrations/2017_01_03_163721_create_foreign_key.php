<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_products', function(Blueprint $table){
            $table->foreign('order_id')->references('id')->on('orders')
                ->onUpdate('restrict')
                ->onDelete('restrict');
    
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    
        Schema::table('baskets_products', function(Blueprint $table){
            $table->foreign('basket_id')->references('id')->on('baskets')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    
        Schema::table('config', function(Blueprint $table){
            $table->foreign('updated_by')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    
        Schema::table('orders', function(Blueprint $table){
            $table->foreign('viewed_by')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    
        Schema::table('baskets', function(Blueprint $table){
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('restrict')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_products', function(Blueprint $table){
            $table->dropForeign('orders_products_order_id_foreign');
            $table->dropForeign('orders_products_product_id_foreign');
        });
    
        Schema::table('baskets_products', function(Blueprint $table){
            $table->dropForeign('baskets_products_basket_id_foreign');
            $table->dropForeign('baskets_products_product_id_foreign');
        });
    
        Schema::table('config', function(Blueprint $table){
            $table->dropForeign('config_updated_by_foreign');
        });
    
        Schema::table('orders', function(Blueprint $table){
            $table->dropForeign('orders_viewed_by_foreign');
        });
    
        Schema::table('baskets', function(Blueprint $table){
            $table->dropForeign('baskets_created_by_foreign');
        });
    }
}
