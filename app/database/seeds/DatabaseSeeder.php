<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        //mass assignment kurallarını ezelim
		Eloquent::unguard();

        //User tablosu seedi
		$this->call('UsersTableSeeder');
        $this->command->info('User tablosu seedlendi!');

        //Kategori tablosu seedi
        $this->call('CategoryTableSeeder');
        $this->command->info('Kategori tablosu seedlendi!');

        //Blog tablosu seedi
        $this->call('BlogTableSeeder');
        $this->command->info('Blog tablosu seedlendi!');

        //Etiket tablosu seedi
        $this->call('TagsTableSeeder');
        $this->command->info('Etiket tablosu seedlendi!');

        //Blog tag (pivot) tablosu seedi
        $this->call('BlogTagTableSeeder');
        $this->command->info('blog_tag pivot tablosu seedlendi!');

        //Usermeta tablosu seedi
        $this->call('UsermetaTableSeeder');
        $this->command->info('User Meta tablosu seedlendi!');

    }

}
