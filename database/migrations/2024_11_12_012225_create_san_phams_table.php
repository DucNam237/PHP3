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
        Schema::create('san_phams', function (Blueprint $table) {
            $table->id();
            $table->string('ma_san_pham',10);
            $table->string('ten_san_pham',20)->unique();
            $table->decimal('gia',10,2);
            $table->decimal('gia_khuyen_mai',10,2)->nullable(); //cho phép trường có giá trị null
            $table->unsignedInteger('so_luong');
            $table->date('ngay_nhap');
            $table->text('mo_ta')->nullable();
            $table->boolean('trang_thai')->default(true); // xet giá trị mặc định cho trường
            $table->timestamps(); //tự sinh ra trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_phams');
    }
};
