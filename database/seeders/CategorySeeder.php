<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name' => 'Массаж',
                'description' => 'Классический, антицеллюлитный, релаксирующий, точечный массаж',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'СПА-процедуры для тела',
                'description' => 'Обертывания, скрабирование, уход за телом',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Уход за лицом',
                'description' => 'Чистка лица, пилинги, массаж лица, маски',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'СПА-ритуалы',
                'description' => 'Комплексные программы релаксации',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Гидротерапия',
                'description' => 'Ванны, душ, гидромассаж',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}