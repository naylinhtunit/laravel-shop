<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            array(
                'name'=>'Admin',
                'username'=>'admin',
                'email'=>'admin@demo.com',
                'password'=>Hash::make('123456'),
                'role_id'=>1,
                'status'=>'active',
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'name'=>'Manager',
                'username'=>'manager',
                'email'=>'manager@demo.com',
                'password'=>Hash::make('123456'),
                'role_id'=>2,
                'status'=>'active',
                'created_at'=>date("Y-m-d H:i:s")
            ),
            array(
                'name'=>'User',
                'username'=>'user',
                'email'=>'user@demo.com',
                'password'=>Hash::make('123456'),
                'role_id'=>3,
                'status'=>'active',
                'created_at'=>date("Y-m-d H:i:s")
            ),
        );

        DB::table('users')->insert($data);
    }
}
