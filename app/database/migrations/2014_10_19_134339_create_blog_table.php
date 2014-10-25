<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogTable extends Migration {

	/**
	 * Migration çalıştırılınca çalışacak işlemler
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('categoryId')->unsigned()->default(0)->index();
			$table->foreign('categoryId')->references('id')->on('categories')->onDelete('cascade');

			$table->string('title', 400)->default('');

			$table->text('post')->default('');

			$table->timestamps(); //oluşturulma ve güncellenme saatleri

			$table->softDeletes(); //soft deleting için
		});
	}


	/**
	 * Migration geri alınınca alınacak işlemler
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blog');
	}

}
