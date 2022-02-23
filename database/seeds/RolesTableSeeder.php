<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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
                'name'=> 'Admin',
                'slug'=> 'admin',
                'created_at'=> date("Y-m-d H:i:s")
            ),
            array(
                'name'=> 'Manager',
                'slug'=> 'manager',
                'created_at'=> date("Y-m-d H:i:s")
            ),
            array(
                'name'=> 'User',
                'slug'=> 'user',
                'created_at'=> date("Y-m-d H:i:s")
            ),
        );

        DB::table('roles')->insert($data);
    }
}
