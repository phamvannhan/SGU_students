<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::where("email", "admin@khoamoitruong.vn")->first();
        if(!$user){
            $arr = [
                'name' => 'Admin',
                'email' => 'admin@khoamoitruong.vn',
                "password" => \Hash::make("khoamoitruong.vn"),
                "students_code" => '311441002018',
                "active" => 1,
                "phone" => '0969590238',
                "address" => 'KtxDHSG'
            ];

            $user = \App\Models\User::create($arr);

        }
        $admin = \App\Models\Role::where("slug", "admin")->first();
        if($admin){
            $user->syncRoles([$admin->id]);
        }
    }
}
