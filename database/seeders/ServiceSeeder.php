<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('services')->insert([
            [
                'title' => 'Классический массаж спины',
                'description' => 'Снятие мышечного напряжения, улучшение кровообращения',
                'price' => 85,
                'duration' => 60,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Шоколадное обертывание',
                'description' => 'Питание и увлажнение кожи, антицеллюлитный эффект',
                'price' => 200,
                'duration' => 60,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Чистка лица комбинированная',
                'description' => 'Глубокое очищение пор, удаление черных точек',
                'price' => 200,
                'duration' => 60,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'СПА-ритуал "Восточная сказка"',
                'description' => 'Хаммам, пилинг, массаж с маслами, чайная церемония',
                'price' => 550,
                'duration' => 150,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Контрастный душ',
                'description' => 'Закаливание, улучшение тонуса кожи',
                'price' => 190,
                'duration' => 15,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}