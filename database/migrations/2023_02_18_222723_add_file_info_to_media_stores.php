<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('media_stores', function (Blueprint $table) {
            $fileInfo = ['audio_length'=>null,'file_size'=>null];
            $table->string('meta_info',250)->default(json_encode($fileInfo));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('media_stores', function (Blueprint $table) {
            $table->dropColumn('meta_info');
        });
    }
};
