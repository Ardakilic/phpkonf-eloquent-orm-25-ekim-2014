<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	/**
	 * Migration çalıştırılınca çalışacak işlemler
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			//yükselen sütun id
			$table->increments('id');

			//400 karakterlik text type
            $table->string('title', 400)->default('');

            //bu tabloda timestamp olmasın
			//$table->timestamps();
		});
	}


	/**
	 * Migration geri alınınca alınacak işlemler
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('categories');
	}

}
