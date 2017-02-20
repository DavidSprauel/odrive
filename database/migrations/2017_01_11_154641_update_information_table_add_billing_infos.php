<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInformationTableAddBillingInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informations', function (Blueprint $table) {
            $table->string('billing_lastname', 50)->nullable()->after('city');
            $table->string('billing_firstname', 50)->nullable()->after('billing_lastname');
            $table->string('billing_address', 255)->nullable()->after('billing_firstname');
            $table->string('billing_address_comp', 255)->nullable()->after('billing_address');
            $table->string('billing_zipcode', 10)->nullable()->after('billing_address_comp');
            $table->integer('billing_country', false, true)->nullable()->after('billing_zipcode');
            $table->string('billing_city', 50)->nullable()->after('billing_country');
            $table->string('billing_phone', 50)->nullable()->after('billing_city');
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
            $table->dropColumn('billing_lastname');
            $table->dropColumn('billing_firstname');
            $table->dropColumn('billing_address');
            $table->dropColumn('billing_address_comp');
            $table->dropColumn('billing_zipcode');
            $table->dropColumn('billing_country');
            $table->dropColumn('billing_city');
            $table->dropColumn('billing_phone');
        });
    }
}
