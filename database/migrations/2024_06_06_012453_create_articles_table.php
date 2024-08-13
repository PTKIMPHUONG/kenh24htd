<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->text('shortcut')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('author_name');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->index(['title', 'content'], 'fulltext_title_content');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
