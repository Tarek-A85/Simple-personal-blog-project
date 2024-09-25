<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(['Sport', 'Education', 'Self Improvement', 'Stories', 'Thoughts', 'Relationships'] as $type){

            Category::create([
                'type' => $type,
            ]);

        }
    }
}
