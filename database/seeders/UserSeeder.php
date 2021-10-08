<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date=date('Y-m-d');
		$time=date('h:i:s a');
        $all_time=date('Y-m-d H:i:s');

        User::updateOrCreate([
            'first_name'        =>'Ibrahim',
            'last_name'         =>'Khalil',
            'email'             =>'ibrahim@gmail.com',
            'password'          =>"123456",
            'sex'               =>"Male",
            'birthday'          =>"1992-12-01",
        ]);
        
        
    }
}