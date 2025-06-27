<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTermsTableToPostTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('terms', function (Blueprint $table) {
            $table->renameColumn('id_post', 'post_id');
            $table->renameColumn('id_terms', 'tag_id');
            $table->dropTimestamps();
        });

        Schema::rename('terms', 'post_tag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('post_tag', 'terms');

        Schema::table('terms', function (Blueprint $table) {
            $table->renameColumn('post_id', 'id_post');
            $table->renameColumn('tag_id', 'id_terms');
            $table->timestamps();
        });
    }
}