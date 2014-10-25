<?php

class TagsTableSeeder extends Seeder {

    public function run()
    {

        Tag::create([
            'tag' => 'etiket1',
        ]);

        Tag::create([
            'tag' => 'etiket2',
        ]);

        Tag::create([
            'tag' => 'etiket3',
        ]);
    }

}