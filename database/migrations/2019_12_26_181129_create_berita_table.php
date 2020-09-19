<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeritaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('berita');
        Schema::create('berita', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content')->nullable();
            $table->integer('author');
            $table->integer('id_kategori');
            $table->integer('id_media')->nullable();
            $table->string('ket_photo')->nullable();
            $table->string('yt_video')->nullable();
            $table->integer('status');
            $table->bigInteger('view')->default(0);
            $table->timestamp('publish_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berita');
    }
}
