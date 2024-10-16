<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfileHeaderValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileHeaderValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profile_header_values = [
            [
                'id' => 1,
                'profile_header_id' => 3,
                'value_name' => 'High school',
                'value_name_ar' => 'تعليم عالى',
            ],
            [
                'id' => 2,
                'profile_header_id' => 3,
                'value_name' => 'Non-degree qualification',
                'value_name_ar' => 'مؤهل غير جامعي',
            ],
            [
                'id' => 3,
                'profile_header_id' => 3,
                'value_name' => 'Undergraduate degree',
                'value_name_ar' => '',
            ],
            [
                'id' => 4,
                'profile_header_id' => 3,
                'value_name' => 'Postgraduate degree',
                'value_name_ar' => 'الدرجة الجامعية',
            ],
            [
                'id' => 5,
                'profile_header_id' => 3,
                'value_name' => 'Doctorate',
                'value_name_ar' => 'دكتوراه',
            ],
            [
                'id' => 6,
                'profile_header_id' => 3,
                'value_name' => 'Other education level',
                'value_name_ar' => 'مستوى تعليمي آخر',
            ],
        ];
        ProfileHeaderValue::insert($profile_header_values);
    }
}
