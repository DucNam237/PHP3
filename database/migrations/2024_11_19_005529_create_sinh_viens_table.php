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
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string("ma_sinh_vien", 10)->unique(); 
            $table->string("ten_sinh_vien", 50); 
            $table->string("hinh_anh")->nullable();
            $table->date("ngay_sinh");
            $table->string("so_dien_thoai", 15); 
            $table->boolean("trang_thai")->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sinh_viens');
    }
};
