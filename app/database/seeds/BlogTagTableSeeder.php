<?php

class BlogTagTableSeeder extends Seeder {

    public function run()
    {

        //Seeding'leri illa Eloquent modelleri ile yazmak zorunda değiliz
        DB::table('blog_tag')->insert([
            [
                'blog_id'   => 1,
                'tag_id'    => 1,
                'random'    => 'hodor',
            ],

            [
                'blog_id'   => 1,
                'tag_id'    => 2,
                'random'    => 'hodor2',
            ],

            [
                'blog_id'   => 2,
                'tag_id'    => 3,
                'random'    => 'hodor3',
            ],

            [
                'blog_id'   => 3,
                'tag_id'    => 3,
                'random'    => 'hodor4',
            ]

        ]);

    }

}