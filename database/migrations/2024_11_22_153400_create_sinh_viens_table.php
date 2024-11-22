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
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->id();
            $table->string("ma_sinh_vien", 10)->unique(); // Đảm bảo mã sinh viên là duy nhất
            $table->string("ten_sinh_vien", 50); // Tăng độ dài nếu cần
            $table->string("hinh_anh")->nullable();
            $table->date("ngay_sinh");
            $table->string("so_dien_thoai", 15); // Đổi từ decimal sang string
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
