<?php

/*
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
*/

class User extends Eloquent /* implements UserInterface, RemindableInterface */ {

    //primary key farklı olursa bu değişkenle tanımlayabiliriz:
    protected $primaryKey = 'id';

    //hangi sütuna mass assignment yapılanasın?
    protected $guarded = ['id'];

    //RELATIONSHIPLER
    //One - to - one relationshipler
    public function meta() {
        return $this->hasOne('Usermeta');
    }

}