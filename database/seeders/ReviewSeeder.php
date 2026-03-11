<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'user_id' => 2,
                'service_id' => 3,
                'rating' => 5,
                'comment' => 'Полный релакс! После массажа как заново родилась. Мария настоящий профессионал!',
                'review_date' => '2026-02-11',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'service_id' => 1,
                'rating' => 5,
                'comment' => 'Чистка лица прошла отлично, кожа дышит. Елена очень аккуратно все сделала. Обязательно приду еще!',
                'review_date' => '2026-02-13',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}