<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVillageIdToMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maps', function (Blueprint $table) {
            $table->unsignedBigInteger('village_id')->after('region_id');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maps', function (Blueprint $table) {
            $table->dropForeign('maps_village_id_foreign');
            $table->dropColumn('village_id');
        });
    }
}
