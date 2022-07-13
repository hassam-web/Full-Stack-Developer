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
            $table->unsignedBigInteger('post_category_id');
            $table->string('post_title',200);
            $table->string('post_author',200);
            $table->string('post_date',200);
            $table->longText('image')->nullable();
            $table->longText('post_content');
            $table->longText('post_tags')->nullable();
            $table->enum('post_status', ['draft','publish'])->default('draft');
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