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
        Schema::create('work_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_report_id')->constrained()->comment('日報ID');
            $table->foreignId('work_detail_category_id')->constrained()->comment('カテゴリーID');
            $table->text('content')->comment('内容');
            $table->time('work_time')->comment('作業時間');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_details');
    }
};
