<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
     {
        \DB::table('jobs')->insert([
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => null,
            'str'=>'学生', 
        ],
        [
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' =>null,
            'str'=>'社会人', 
        ],
        ]);
    }
}
