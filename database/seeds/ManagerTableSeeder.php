<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=\Faker\factory::create('zh_CN');
        $line=[];
        for ($i=0;$i<100;$i++){
            $line[]= [
                'username' => $faker->userName,
                'password' =>bcrypt(123456),
                'tel' =>$faker->phoneNumber,
                'email' =>$faker->email,
                'time' =>$faker->dateTime,
                'state' =>rand(0,1),
            ];
        }
        DB::table('user')->insert($line);
    }
}
