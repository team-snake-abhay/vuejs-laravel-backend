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
        Schema::create('media_stores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title',200)->nullable();
            $table->string('gs_path',200)->nullable();
            $table->string('local_path',150)->nullable();
            $table->longText('transcript')->nullable();
            $table->tinyInteger('transcription_status')->default(0)->comment('0-not done, 1-done');
            $table->enum('media_type', ['image', 'audio', 'video'])->default('image');
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
        Schema::dropIfExists('media_stores');
    }
};
