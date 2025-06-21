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
        Schema::rename('pengumumen', 'announcements');

        Schema::table('announcements', function (Blueprint $table) {
            $table->renameColumn('id_media', 'media_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcements', function (Blueprint $table) {
            $table->renameColumn('media_id', 'id_media');
        });

        Schema::rename('announcements', 'pengumumen');
    }
};