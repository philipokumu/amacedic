<?php

use Illuminate\Database\Seeder;
use App\Coupon;

class CouponsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'couponName'=> 'newCustomer',
            'couponCode'=> 'NEW10',
            'type'=> 'percent',
            'description'=> 'Welcome new user',
            'percent_off'=> 10,
        ]);

        Coupon::create([
            'couponName'=> '10orders',
            'couponCode'=> 'PAGEOFF11',
            'orderBasedCouponValue'=> '10',
            'type'=> 'page',
            'description'=> 'User has made 10 orders',
            'page_off'=> 1,
        ]);

    }
}
