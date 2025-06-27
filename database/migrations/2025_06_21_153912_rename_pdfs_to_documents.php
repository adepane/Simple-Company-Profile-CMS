<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePdfsToDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('pdfs', 'documents');

        Schema::table('pengumumen', function (Blueprint $table) {
            $table->renameColumn('id_pdf', 'document_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('documents', 'pdfs');

        Schema::table('pengumumen', function (Blueprint $table) {
            $table->renameColumn('document_id', 'id_pdf');
        });
    }
}