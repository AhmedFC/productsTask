<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        $categories = [
            ['id' => 1, 'name' => 'Meets'],
            ['id' => 2, 'name' => 'Clothes'],
            ['id' => 3, 'name' => 'Electronics'],
        ];

     \App\Models\Category::insert($categories);

    }
}
