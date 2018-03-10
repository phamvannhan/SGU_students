<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        if(Schema::hasTable('country')
            && Schema::hasTable('city')
            && \DB::table('country')->get()->count() < 1
        ){
            $this->call(LocationDataSeeder::class);
        }
    }
}
