<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Thời sự'],
            ['name' => 'Thể thao'],
            ['name' => 'Kinh doanh'],
            ['name' => 'Giáo dục'],
            ['name' => 'Công nghệ'],
        ]);
    }
}