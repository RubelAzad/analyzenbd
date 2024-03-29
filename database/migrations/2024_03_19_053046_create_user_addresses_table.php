<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('custom_users')->onDelete('cascade');
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    // public function down()
    // {
    //     Schema::dropIfExists('user_addresses');
    // }
        public function down()
        {
            Schema::table('user_addresses', function (Blueprint $table) {
                $table->dropForeign(['custom_user_id']);
            });

            Schema::dropIfExists('custom_users');
        }
};
