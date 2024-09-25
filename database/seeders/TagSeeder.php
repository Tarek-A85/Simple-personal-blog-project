<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach( ['Football', 'University', 'Back-end', 'Books', 'Socializing', 'Making friends', 'Imagination']
                  as 
                  $name ){

            Tag::create([
                'name' => $name,

            ]);
        }
    }
}
