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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->text('cards');
            $table->string('title',100);
            $table->string('pw',20)->nullable();
            $table->bigInteger('audio_id')->default(0);
            $table->bigInteger('chapter_id')->default(0);
            $table->bigInteger('user_id')->default(0);
            $table->text('thumbnail')->nullable();
            $table->integer('total_view')->default(0);
            $table->integer('like')->default(0);
            $table->integer('dislike')->default(0);
            $table->integer('heart')->default(0);
            $table->integer('satisfied')->default(0);
            $table->integer('sad')->default(0);
            $table->integer('angry')->default(0);
            $table->string('uuid',50)->nullable();
            $table->string('background_audio',200)->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
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
        Schema::dropIfExists('stories');
    }
};
