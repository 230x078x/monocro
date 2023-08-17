<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('menus')->insert([
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'name'=>'ビール',
            'price'=>600
            
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' =>null,
            'name'=>'ワイン',
            'price'=>500
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' =>null,
            'name'=>'サワー',
            'price'=>400
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' =>null,
            'name'=>'ハイボール',
            'price'=>700
        ],
        ]);
    }
}
