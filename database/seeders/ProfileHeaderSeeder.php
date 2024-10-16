<?php

namespace Database\Seeders;

use App\Models\ProfileHeader;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile_headers = [
            [
                'id' => 1,
                'type' => 'Interests',
            ],
            [
                'id' => 2,
                'type' => 'Personality',
            ],
            [
                'id' => 3,
                'type' => 'Education',
            ],
            [
                'id' => 4,
                'type' => 'Languages',
            ],
        ];
        ProfileHeader::insert($profile_headers);
    }
}
