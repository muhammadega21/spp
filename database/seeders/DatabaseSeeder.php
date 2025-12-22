<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'wali'
        ]);
        User::create([
            'name' => 'anto',
            'email' => 'anto@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'wali'
        ]);
        StudentClass::create([
            'name' => 'X-RPL 1',
            'Competency' => 'Rekayasa Perangkat Lunak',
        ]);
        StudentClass::create([
            'name' => 'X-RPL 2',
            'Competency' => 'Rekayasa Perangkat Lunak',
        ]);

        Student::create([
            'nis' => '00123456',
            'guardian_id' => 2,
            'class_id' => 1,
            'name' => 'Andi Saputra',
            'year' => 2025
        ]);
        Student::create([
            'nis' => '00123457',
            'guardian_id' => 3,
            'class_id' => 2,
            'name' => 'Budi Santoso',
            'year' => 2024
        ]);
    }
}
