<?php

namespace Database\Seeders;

use App\Models\Explore;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExploreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $explores = [
            [
                'id' => 1,
                'name' => 'Visited you',
            ],
            [
                'id' => 2,
                'name' => 'Liked you',
            ],
            [
                'id' => 3,
                'name' => 'Favourite',
            ],
            [
                'id' => 4,
                'name' => 'Passed',
            ],
            [
                'id' => 5,
                'name' => 'Send compliment',
            ],
        ];
        Explore::insert($explores);
    }
}
