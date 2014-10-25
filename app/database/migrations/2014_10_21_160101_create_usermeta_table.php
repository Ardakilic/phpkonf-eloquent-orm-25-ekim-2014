<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsermetaTable extends Migration {

    /**
     * Migration çalıştırılınca çalışacak işlemler
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usermeta', function(Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->default(0)->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('address', 400)->default(0);
            
        });
    }


    /**
     * Migration geri alınınca alınacak işlemler
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usermeta');
    }

}
