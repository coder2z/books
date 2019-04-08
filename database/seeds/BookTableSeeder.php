<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //产生faker实例
        $faker=\Faker\factory::create('zh_CN');
        $line=[];
        for ($i=0;$i<100;$i++){
            $line[]= [
                'ISBN' =>$faker->isbn10(),
                'book_name' =>$faker->name.'图书',
                'book_author' =>$faker->name.'作者',
                'press' =>$faker->name.'出版社',
                'publication_time' =>$faker->dateTime,
                'number' =>rand(0,1000),
                'add_time' =>$faker->dateTime,
                'classify_id' =>rand(0,5),
                'avatar' =>'\storage\open_sy_193162796464.jpg',
            ];
        }
        DB::table('book')->insert($line);
    }
}