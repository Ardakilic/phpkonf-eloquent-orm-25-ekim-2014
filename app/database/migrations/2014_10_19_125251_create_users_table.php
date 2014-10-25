<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Migration çalıştırılınca çalışacak işlemler
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');

            $table->string('first_name')->default('');
            $table->string('last_name')->default('');

            $table->string('email')->default('')->unique();

            $table->string('password', 400)->default('');

			$table->timestamps();
		});
	}


	/**
	 * Migration geri alınınca alınacak işlemler
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}