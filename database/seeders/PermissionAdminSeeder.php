<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAdminSeeder extends Seeder
{

    /**
     * List of applications to add.
     */
    private $permissions = [
        'الفواتير',
        'قائمة الفواتير',
        'الفواتير المدفوعة',
        'الفواتير المدفوعة جزئيا',
        'الفواتير الغير مدفوعة',
        'الفواتير المؤرشفة',
        'التقارير',
        'تقارير الفواتير',
        'تقارير العملاء',
        'المستخدمين',
        'قائمة المستخدمين',
        'صلاحيات المستخدمين',
        'الاعدادات',
        'الاقسام',
        'المنتجات',

        'أضف فاتورة',
        'حذف الفاتورة',
        'تغير حالة الدفع',
        'تعديل الفاتورة',
        ' نقل الي الارشيف',
        'طباعةالفاتورة',
        'اضافة مرفق',
        'حذف المرفق',

        'اضافة مستخدم',
        'تعديل مستخدم',
        'حذف مستخدم',

        'عرض صلاحية',
        'اضافة صلاحية',
        'تعديل صلاحية',
        'حذف صلاحية',

        'اضافة منتج',
        'تعديل منتج',
        'حذف منتج',

        'اضافة قسم',
        'تعديل قسم',
        'حذف قسم',
        'الاشعارات',
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create admin User and assign the role to him.
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
            'roles_name' => ["Admin"],
            'Status' => 'مفعل'
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();
        
        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}