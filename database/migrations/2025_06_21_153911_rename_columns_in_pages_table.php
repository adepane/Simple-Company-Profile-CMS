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
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->renameColumn('judul', 'title');
                $table->renameColumn('id_media', 'media_id');
                $table->renameColumn('ket_photo', 'img_description');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pages')) {
            Schema::table('pages', function (Blueprint $table) {
                $table->renameColumn('title', 'judul');
                $table->renameColumn('media_id', 'id_media');
                $table->renameColumn('img_description', 'ket_photo');
            });
        }
    }
};
