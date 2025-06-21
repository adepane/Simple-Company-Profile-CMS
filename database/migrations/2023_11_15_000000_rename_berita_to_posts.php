<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameBeritaToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('berita', function (Blueprint $table) {
            $table->renameColumn('id_kategori', 'category_id');
            $table->renameColumn('id_media', 'media_id');
        });

        Schema::rename('berita', 'posts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('posts', 'berita');

        Schema::table('berita', function (Blueprint $table) {
            $table->renameColumn('category_id', 'id_kategori');
            $table->renameColumn('media_id', 'id_media');
        });
    }
}