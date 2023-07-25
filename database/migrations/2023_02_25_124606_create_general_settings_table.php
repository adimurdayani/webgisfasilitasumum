<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('author', 128)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('app_name')->nullable();
            $table->text('address')->nullable();
            $table->string('city', 150)->nullable();
            $table->string('province', 150)->nullable();
            $table->string('country', 150)->nullable();
            $table->string('tax_number', 150)->nullable();
            $table->text('about_site')->nullable();
            $table->string('copyright_text', 150)->nullable();
            $table->string('link_website')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_youtube')->nullable();
            $table->string('link_whatsapp')->nullable();
            $table->text('img_fav')->nullable();
            $table->text('img_sm')->nullable();
            $table->text('img_lg')->nullable();
            $table->text('img_nota')->nullable();
            $table->text('img_user')->nullable();
            $table->string('captcha_secret')->nullable();
            $table->string('captcha_site_key')->nullable();
            $table->double('captcha_is_active')->default(false);
            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->text('seo_meta_description')->nullable();
            $table->string('author_name')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_img')->nullable();
            $table->string('goggle_analytics_id')->nullable();
            $table->text('costum_js')->nullable();
            $table->string('addthis_script')->nullable();
            $table->string('addthis_toolbox_code')->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('general_settings');
    }
}
