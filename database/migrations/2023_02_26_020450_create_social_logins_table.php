<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_logins', function (Blueprint $table) {
            $table->id();
            $table->string('fb_client_id')->nullable();
            $table->string('fb_client_secret_key')->nullable();
            $table->boolean('fb_is_active')->default(false);
            $table->string('g_client_id')->nullable();
            $table->string('g_client_secret_key')->nullable();
            $table->boolean('g_is_active')->default(false);
            $table->string('git_client_id')->nullable();
            $table->string('git_client_secret_key')->nullable();
            $table->boolean('git_is_active')->default(false);
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
        Schema::dropIfExists('social_logins');
    }
}
