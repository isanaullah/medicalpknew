<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Administrative Permissions
        $adminPermissions = [
            'admin.access',
            'admin.courses.manage',
            'admin.categories.manage',
            'admin.curriculum.manage',
            'admin.instructors.manage',
            'admin.students.manage',
            'admin.enrollments.manage',
            'admin.reviews.manage',
            'admin.certificates.manage',
            'admin.blog.manage',
            'admin.faqs.manage',
            'admin.pages.manage',
            'admin.media.manage',
            'admin.notifications.manage',
            'admin.messages.manage',
            'admin.subscribers.manage',
            'admin.settings.manage',
        ];

        // Student Permissions
        $studentPermissions = [
            'student.access',
            'student.courses.view',
            'student.wishlist.manage',
            'student.certificates.view',
            'student.notifications.view',
            'student.profile.manage',
        ];

        $allPermissions = array_unique(array_merge($adminPermissions, $studentPermissions));

        foreach ($allPermissions as $permName) {
            Permission::firstOrCreate(['name' => $permName, 'guard_name' => 'web']);
        }

        // Exactly Two Roles: Super Admin and Student
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $superAdminRole->syncPermissions(Permission::all());

        $studentRole = Role::firstOrCreate(['name' => 'Student', 'guard_name' => 'web']);
        $studentRole->syncPermissions($studentPermissions);
    }
}
