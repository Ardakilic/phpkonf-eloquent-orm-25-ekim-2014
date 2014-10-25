<?php

class BlogTableSeeder extends Seeder {

    public function run()
    {

        Blog::create([
            'categoryId'    => 1,
            'title'         => 'Blog Başlığı',
            'post'          => 'In finibus mollis vestibulum. Nullam posuere nibh non nisi maximus accumsan tempor ut erat. Duis placerat orci elit, nec lacinia dolor placerat a. Nulla vel ipsum sem. Nulla vitae dictum lacus, id aliquam metus. Nulla a est a diam viverra maximus. Nam ut ante erat. ',
        ]);

        Blog::create([
            'categoryId'    => 1,
            'title'     => 'Başka Bir Blog Başlığı',
            'post'      => 'Proin nulla felis, rhoncus sit amet libero viverra, euismod congue elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque fermentum mauris sed iaculis luctus. Vivamus pretium ex commodo neque laoreet, sed ullamcorper justo molestie. Maecenas facilisis porttitor metus vel vulputate. Proin eget dui bibendum, ultrices velit sollicitudin, tristique purus. Vivamus arcu urna, consectetur sit amet mattis eget, aliquam sit amet ipsum. Duis sed magna id tortor sodales lobortis eu in tellus. ',
        ]);


        Blog::create([
            'categoryId'    => 2,
            'title'         => 'Silinmiş Blog Başlığı',
            'post'          => 'Hodor hodor hodor hodor. Hodor. Hodor hodor - hodor... Hodor hodor hodor hodor hodor! Hodor hodor, hodor. Hodor hodor - hodor, hodor, hodor hodor. Hodor! Hodor hodor, hodor hodor hodor; hodor hodor?! Hodor. Hodor hodor... Hodor hodor hodor; hodor hodor. Hodor! Hodor hodor, hodor hodor... Hodor hodor HODOR hodor, hodor hodor hodor hodor hodor! Hodor hodor - hodor - hodor. Hodor hodor HODOR! Hodor hodor hodor - hodor hodor?!',

            //deleted_at sütununda timestamp var
            'deleted_at'    => '2013-12-31 23:59:00',
        ]);


    }

}