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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();

            $table->string('username', 60)->nullable()->unique();

            $table->string('mobile', 20)->nullable()->unique();
            $table->string('otp',6)->nullable();
            $table->timestamp('mobile_varified_at')->nullable();

            $table->string('address', 190)->nullable();
            $table->string('subscription', 20)->default('basic');
            $table->integer('status')->default(1)->comment('0-Inactive, 1-Active');
            $table->string('image', 50)->default('no-image.png');
            $table->string('url', 50)->default('/');
            $table->integer('created_by')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
