<?php

use Illuminate\Database\Seeder;

class CouponsTableSeeder extends Seeder
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
                'code'=>'abc123',
                'type'=>'fixed',
                'value'=>'1000',
                'status'=>'active'
            ),
            array(
                'code'=>'123abc',
                'type'=>'percent',
                'value'=>'200',
                'status'=>'active'
            ),
        );

        DB::table('coupons')->insert($data);
    }
}
