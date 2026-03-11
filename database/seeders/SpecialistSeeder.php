<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SpecialistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specialists')->insert([
            [
                'name' => 'Анна Смирнова',
                'bio' => 'Ведущий СПА-терапевт. Специализируется на массажах и обертываниях. Стаж 10 лет.',
                'photo_path' => 'specialists/anna.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Елена Козлова',
                'bio' => 'Косметолог-эстетист. Проводит чистки лица, пилинги и уходовые процедуры. Стаж 8 лет.',
                'photo_path' => 'specialists/elena.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Мария Петрова',
                'bio' => 'Мастер по массажу. Классический, антицеллюлитный, релаксирующий массаж. Стаж 12 лет.',
                'photo_path' => 'specialists/maria.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}