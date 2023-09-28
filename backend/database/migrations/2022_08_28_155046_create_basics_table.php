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
        Schema::create('basics', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 191);
            $table->string('address', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('contact_number', 40)->nullable();
            $table->string('facebook_link', 191)->nullable();
            $table->string('youtube_link', 191)->nullable();
            $table->string('linkedin_link', 191)->nullable();
            $table->string('instagram_link', 191)->nullable();
            $table->string('header_image', 191)->nullable();
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('basics');
    }
};
