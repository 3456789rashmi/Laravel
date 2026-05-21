<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Mandatory import for DB facade

class teacher_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teacher')->insert([
            [
                'name'=>'Rashmi',
                'email' => 'rashmi@gmail.com',
                'subject' => 'dxfchgvjhbk'
            ],
            [
                'name'=>'Tunu',
                'email'=>'tunu@gmail.com',
                'subject'=>'Maths'
                ],
                [
                    'name'=>'Suman',
                    'email'=>'suman@gmail.com',
                    'subject'=>'Science'
                ]
            ]);
        }
    }

//open xampp turn on apache and mysql
//open phpmyadmin 
//open .env file update database name uncomment from line 22 to 28 database connectwith mysql
//create migration php artisan make:migration create_teacher_table
//php artisan migrate
//create seeder teacher_seeder add mandatory import from seeder and add route 
//open database seeder and call your seeder class ( i.e teacher_seeder)
// run php artisan:db seed
