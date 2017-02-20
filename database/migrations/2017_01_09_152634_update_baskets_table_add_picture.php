<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBasketsTableAddPicture extends Migration
{
    public function up()
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->string('picture', 254)->default(null)->after('price');
        });
    }

    public function down()
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->dropColumn('picture');
        });
    }
}
