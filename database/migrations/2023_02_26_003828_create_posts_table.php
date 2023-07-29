<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id');
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreignId('subcategorie_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('slug');
            $table->text('content');
            $table->string('image');
            $table->text('image_description');
            $table->text('img_thumb_video')->nullable();
            $table->string('url_video')->nullable();
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->string('meta_description');
            $table->string('meta_tag');
            $table->enum('publish', ['Publish', 'Draf'])->default('Publish');
            $table->enum('type', ['Article', 'Video'])->default('Article');
            $table->boolean('is_active');
            $table->integer('views')->unsigned()->nullable();
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
        Schema::dropIfExists('posts');
    }
}
