<?php

namespace Database\Seeders;

use App\Models\App_key;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class App_keySeeder extends Seeder
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
        $app_key='1E4E84821FC946DEC1B8E3FD0301FE03';
        $app_secret='8d2304aa9a96ad657770504811ebaf91';
        App_key::updateOrCreate([
            'app_key'=>$app_key,
            'app_secret'=>$app_secret,
            'date'=>$date,
            'time'=>$time
        ]);
        
    }
}