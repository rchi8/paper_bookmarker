<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable()->comment('URL');
            $table->string('updated')->nullable()->comment('更新日');
            $table->string('published')->nullable()->comment('投稿日');
            $table->string('title')->nullable()->comment('タイトル');
            $table->text('summary')->nullable()->comment('要約');
            $table->string('author1')->nullable()->comment('著者1');
            $table->string('author2')->nullable()->comment('著者2');
            $table->string('author3')->nullable()->comment('著者3');
            $table->text('memo')->nullable()->comment('メモ');
            $table->integer('flag')->default(0)->comment('メモ有無');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
