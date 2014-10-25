<?php

class CategoryTableSeeder extends Seeder {

    public function run()
    {

        Category::create([
            'title' => 'Kategori1',
        ]);

        Category::create([
            'title' => 'Kategori2',
        ]);

        Category::create([
            'title' => 'Kategori3',
        ]);
    }

}