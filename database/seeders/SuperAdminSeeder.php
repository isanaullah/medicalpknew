<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        // Initial Super Admin Account
        $adminEmail = env('SUPER_ADMIN_EMAIL', 'admin@admin.com');
        $adminPassword = env('SUPER_ADMIN_PASSWORD', 'admin');

        $superAdmin = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );

        if (!$superAdmin->hasRole('Super Admin')) {
            $superAdmin->assignRole('Super Admin');
        }

        // Demo Student Account
        $studentEmail = env('DEMO_STUDENT_EMAIL', 'student@student.com');
        $studentPassword = env('DEMO_STUDENT_PASSWORD', 'student');

        $student = User::firstOrCreate(
            ['email' => $studentEmail],
            [
                'name' => 'Elena Petrova',
                'password' => Hash::make($studentPassword),
                'email_verified_at' => now(),
            ]
        );

        if (!$student->hasRole('Student')) {
            $student->assignRole('Student');
        }
    }
}
