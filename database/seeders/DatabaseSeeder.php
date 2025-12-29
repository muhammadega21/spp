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

        StudentClass::create([
            'name' => 'X-RPL 1',
            'competency' => 'Rekayasa Perangkat Lunak'
        ]);
        StudentClass::create([
            'name' => 'X-RPL 2',
            'competency' => 'Rekayasa Perangkat Lunak'
        ]);
        StudentClass::create([
            'name' => 'XI-RPL 1',
            'competency' => 'Rekayasa Perangkat Lunak'
        ]);
        StudentClass::create([
            'name' => 'XI-RPL 2',
            'competency' => 'Rekayasa Perangkat Lunak'
        ]);
        StudentClass::create([
            'name' => 'XII-RPL 1',
            'competency' => 'Rekayasa Perangkat Lunak'
        ]);
        StudentClass::create([
            'name' => 'XII-RPL 2',
            'competency' => 'Rekayasa Perangkat Lunak'
        ]);

        User::factory(99)->create();

        $guardianId = 2;
        Student::factory(99)
            ->make()
            ->each(function ($student) use (&$guardianId) {
                $student->guardian_id = $guardianId;
                $student->save();

                $guardianId++;
            });
    }
}
