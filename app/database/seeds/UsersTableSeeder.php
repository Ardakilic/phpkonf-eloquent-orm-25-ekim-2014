<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {

        User::create([
            'first_name'    => 'Arda',
            'last_name'     => 'Kılıçdağı',
            'email'         => 'ardakilicdagi@gmail.com',
            'password'      => \Hash::make('hodor123'),
        ]);


        User::create([
            'first_name'    => 'Osman',
            'last_name'     => 'Yüksel',
            'email'         => 'yuxel@sonsuzdongu.com',
            'password'      => \Hash::make('Selenium!!!11'),
        ]);


        User::create([
            'first_name'    => 'Emir',
            'last_name'     => 'Karşıyakalı',
            'email'         => 'emirkarsiyakali@gmail.com',
            'password'      => \Hash::make('BarcelonaFC'),
        ]);

    }

}