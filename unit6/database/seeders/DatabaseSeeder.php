<?php

namespace Database\Seeders;

//use App\Models\User;
//use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\student;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call(teacher_seeder::class); //call your seeder here
        student::factory()->count(20)->create(); //count - no of recods to be created
    }
}
