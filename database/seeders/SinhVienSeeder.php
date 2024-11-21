<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SinhVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 5; $i++) {
            DB::table('sinhviens')->insert([
                'ma_sinh_vien' => "$i",
                'ten_sinh_vien' => "Vũ Đức Nam .$i",
                'hinh_anh' => "",
                'ngay_sinh' => date('Y-m-d'),
                'so_dien_thoai' => "0338086390",
                'trang_thai' => true
            ]);
        }
    }
}
