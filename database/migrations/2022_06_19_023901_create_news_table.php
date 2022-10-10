<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('news_id'); // ニュースのID（リンクURLより設定）を保存するカラム
            $table->string('title'); // ニュースのタイトルを保存するカラム
            $table->string('date'); // ニュースの日付を保存するカラム
            $table->string('link'); // ニュースのリンクを保存するカラム
            $table->string('team'); // ニュースのカテゴリー（チーム名）を保存するカラム
            $table->string('description', 1024); // ニュースの説明を保存するカラム
            $table->text('content'); // ニュースのID（リンクURLより設定）を保存するカラム
            $table->text('img_path'); // ニュースのID（リンクURLより設定）を保存するカラム
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
        Schema::dropIfExists('news');
    }
}
