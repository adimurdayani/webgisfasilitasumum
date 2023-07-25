<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('education_id')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('color')->nullable();
            $table->string('icon_marker')->nullable();
            $table->enum('type', ['coordinate', 'file'])->default('coordinate');
            $table->string('geojson')->nullable();
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
        Schema::dropIfExists('coordinates');
    }
}
