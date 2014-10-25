<?php

class UsermetaTableSeeder extends Seeder {

    public function run()
    {

        //Seeding'leri illa Eloquent modelleri ile yazmak zorunda değiliz
        DB::table('usermeta')->insert([
            [
                'user_id'   => 1,
                'address'   => 'Adres1',
            ],

            [
                'user_id'   => 2,
                'address'   => 'Adres2',
            ],

            [
                'user_id'   => 3,
                'address'   => 'Adres3',
            ]

        ]);

    }

}