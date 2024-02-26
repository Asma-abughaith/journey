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

            // Permissions for features CRUD operations
            [
                'name' => 'create feature',
                'translations' => [
                    'ar' => 'إنشاء ميزة',
                    'en' => 'create feature',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit feature',
                'translations' => [
                    'ar' => 'تعديل ميزة',
                    'en' => 'edit feature',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view features',
                'translations' => [
                    'ar' => 'عرض ميزات',
                    'en' => 'view features',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete feature',
                'translations' => [
                    'ar' => 'حذف ميزة',
                    'en' => 'delete feature',
                ],
                'guard_name' => 'admin',
            ],


            // Permissions for Tags CRUD operations
            [
                'name' => 'create tag',
                'translations' => [
                    'ar' => 'إنشاء وسم',
                    'en' => 'create tag',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit tag',
                'translations' => [
                    'ar' => 'تعديل وسم',
                    'en' => 'edit tag',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view tags',
                'translations' => [
                    'ar' => 'عرض الاوسمة',
                    'en' => 'view tags',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete tag',
                'translations' => [
                    'ar' => 'حذف وسم',
                    'en' => 'delete tag',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for Places CRUD operations
            [
                'name' => 'create place',
                'translations' => [
                    'ar' => 'إنشاء منطقة',
                    'en' => 'create place',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit place',
                'translations' => [
                    'ar' => 'تعديل منطقة',
                    'en' => 'edit place',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view places',
                'translations' => [
                    'ar' => 'عرض المناطق',
                    'en' => 'view places',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete place',
                'translations' => [
                    'ar' => 'حذف منطقة',
                    'en' => 'delete place',
                ],
                'guard_name' => 'admin',
            ],
            // Permissions for Top Ten Places CRUD operations
            [
                'name' => 'create topTenPlace',
                'translations' => [
                    'ar' => 'إنشاء افضل عشرة اماكن',
                    'en' => 'create topTenPlace',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit topTenPlace',
                'translations' => [
                    'ar' => 'تعديل افضل عشرة اماكن',
                    'en' => 'edit topTenPlace',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view topTenPlaces',
                'translations' => [
                    'ar' => 'عرض افضل عشرة اماكن',
                    'en' => 'view topTenPlaces',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete topTenPlace',
                'translations' => [
                    'ar' => 'حذف افضل عشرة اماكن',
                    'en' => 'delete topTenPlace',
                ],
                'guard_name' => 'admin',
            ],
            // Permissions for Popular Places CRUD operations
            [
                'name' => 'create popularPlaces',
                'translations' => [
                    'ar' => 'إنشاء اماكن شائعة ',
                    'en' => 'create popularPlaces',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit popularPlaces',
                'translations' => [
                    'ar' => 'تعديل  اماكن شائعة',
                    'en' => 'edit popularPlaces',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view popularPlaces',
                'translations' => [
                    'ar' => 'عرض  اماكن شائعة',
                    'en' => 'view popularPlaces',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete popularPlaces',
                'translations' => [
                    'ar' => 'حذف  اماكن شائعة',
                    'en' => 'delete popularPlaces',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for Organizers CRUD operations
            [
                'name' => 'create organizer',
                'translations' => [
                    'ar' => 'إنشاء منظم ',
                    'en' => 'create organizer',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit organizer',
                'translations' => [
                    'ar' => 'تعديل  منظم',
                    'en' => 'edit organizer',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view organizers',
                'translations' => [
                    'ar' => 'عرض  المنظمين',
                    'en' => 'view organizers',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete organizer',
                'translations' => [
                    'ar' => 'حذف  منظم',
                    'en' => 'delete organizer',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for Event CRUD operations
            [
                'name' => 'create event',
                'translations' => [
                    'ar' => 'إنشاء حدث ',
                    'en' => 'create event',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit event',
                'translations' => [
                    'ar' => 'تعديل  حدث',
                    'en' => 'edit event',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view events',
                'translations' => [
                    'ar' => 'عرض  احداث',
                    'en' => 'view events',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete event',
                'translations' => [
                    'ar' => 'حذف  حدث',
                    'en' => 'delete event',
                ],
                'guard_name' => 'admin',
            ],

            // Permissions for Volunteering CRUD operations
            [
                'name' => 'create volunteering',
                'translations' => [
                    'ar' => 'إنشاء تطوع ',
                    'en' => 'create volunteering',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit volunteering',
                'translations' => [
                    'ar' => 'تعديل  تطوع',
                    'en' => 'edit volunteering',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'view volunteerings',
                'translations' => [
                    'ar' => 'عرض  التطوع',
                    'en' => 'view volunteerings',
                ],
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete volunteering',
                'translations' => [
                    'ar' => 'حذف  تطوع',
                    'en' => 'delete volunteering',
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
