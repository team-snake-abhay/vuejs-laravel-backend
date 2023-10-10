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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('package_name',20);
            $table->integer('max_story_length')->default(0);
            $table->integer('story_per_day')->default(0);
            $table->string('analytics',250)->nullable();
            $table->boolean('chapter_organize')->default(false);
            $table->boolean('comment_under_story')->default(false);
            $table->boolean('embedadable_player')->default(false);
            $table->boolean('password_protected')->default(false);
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
        Schema::dropIfExists('subscriptions');
    }
};
