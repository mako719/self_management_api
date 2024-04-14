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
        Schema::create('life_gauges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->comment('ユーザーID');
            $table->string('name')->comment('名前');
            $table->date('date_of_birth')->comment('生年月日');
            $table->integer('target_lifespan')->comment('目標寿命');
            $table->boolean('is_user')->comment('本人 0:本人以外、1:本人');
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('life_gauges');
    }
};
