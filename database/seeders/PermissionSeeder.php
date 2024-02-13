<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Permissions for admin CRUD operations
            [
                'name' => 'create admin',
                'translations' => [
                    'ar' => 'إنشاء مشرف',
                    'en' => 'create admin',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit admin',
                'translations' => [
                    'ar' => 'تعديل مشرف',
                    'en' => 'edit admin',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view admins',
                'translations' => [
                    'ar' => 'عرض المشرفين',
                    'en' => 'view admins',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete admin',
                'translations' => [
                    'ar' => 'حذف مشرف',
                    'en' => 'delete admin',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for role CRUD operations
            [
                'name' => 'create role',
                'translations' => [
                    'ar' => 'إنشاء دور',
                    'en' => 'create role',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit role',
                'translations' => [
                    'ar' => 'تعديل دور',
                    'en' => 'edit role',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view roles',
                'translations' => [
                    'ar' => 'عرض الأدوار',
                    'en' => 'view roles',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete role',
                'translations' => [
                    'ar' => 'حذف دور',
                    'en' => 'delete role',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for category CRUD operations
            [
                'name' => 'create category',
                'translations' => [
                    'ar' => 'إنشاء فئة',
                    'en' => 'create category',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit category',
                'translations' => [
                    'ar' => 'تعديل فئة',
                    'en' => 'edit category',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view categories',
                'translations' => [
                    'ar' => 'عرض الفئات',
                    'en' => 'view categories',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete category',
                'translations' => [
                    'ar' => 'حذف فئة',
                    'en' => 'delete category',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for subcategory CRUD operations
            [
                'name' => 'create subcategory',
                'translations' => [
                    'ar' => 'إنشاء فئة فرعية',
                    'en' => 'create subcategory',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit subcategory',
                'translations' => [
                    'ar' => 'تعديل فئة فرعية',
                    'en' => 'edit subcategory',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view subcategories',
                'translations' => [
                    'ar' => 'عرض الفئات الفرعية',
                    'en' => 'view subcategories',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete subcategory',
                'translations' => [
                    'ar' => 'حذف فئة فرعية',
                    'en' => 'delete subcategory',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for permission CRUD operations
            [
                'name' => 'create permission',
                'translations' => [
                    'ar' => 'إنشاء صلاحية',
                    'en' => 'create permission',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit permission',
                'translations' => [
                    'ar' => 'تعديل صلاحية',
                    'en' => 'edit permission',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view permissions',
                'translations' => [
                    'ar' => 'عرض الصلاحيات',
                    'en' => 'view permissions',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete permission',
                'translations' => [
                    'ar' => 'حذف صلاحية',
                    'en' => 'delete permission',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for regions CRUD operations
            [
                'name' => 'create region',
                'translations' => [
                    'ar' => 'إنشاء منطقة',
                    'en' => 'create region',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit region',
                'translations' => [
                    'ar' => 'تعديل منطقة',
                    'en' => 'edit region',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view regions',
                'translations' => [
                    'ar' => 'عرض المناطق',
                    'en' => 'view regions',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete region',
                'translations' => [
                    'ar' => 'حذف منطقة',
                    'en' => 'delete region',
                ],
                'guard_name' => 'admin',
            ],

        ];

        foreach ($permissions as $permissionData) {
                $permission = Permission::create([
                    'name' => $permissionData['name'],
                    'guard_name' => $permissionData['guard_name'],
                    'name_i18n'=>$permissionData['translations']

                ]);
            $permission->setTranslations('name_i18n', $permissionData['translations']);
        }

    }
}
