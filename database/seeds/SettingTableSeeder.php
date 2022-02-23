<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array(
            'description'=>"test",
            'short_des'=>"test",
            'photo'=>"image.jpg",
            'logo'=>'logo.jpg',
            'address'=>"Yangon, Myanmar",
            'email'=>"info@isure.test",
            'phone'=>"+959 000-000-000",
        );
        DB::table('settings')->insert($data);
    }
}
