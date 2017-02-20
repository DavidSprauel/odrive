<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->string('company', 100)->nullable();
            $table->string('phone', 100);
            $table->string('address', 255);
            $table->string('address_comp', 255)->nullable();
            $table->string('country', 50);
            $table->integer('zipcode', false, true);
            $table->string('city', 50);
            $table->timestamps();
        });
    
        Schema::table('informations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informations', function (Blueprint $table) {
            $table->dropForeign('informations_user_id_foreign');
        });
        Schema::dropIfExists('informations');
    }
}
