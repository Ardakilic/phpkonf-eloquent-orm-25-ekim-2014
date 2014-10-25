<?php

class Usermeta extends \Eloquent {

    //tablo adı
    protected $table = 'usermeta';

    //hiçbir sütunda mass assignment kısıtlaması olmasın
    protected $guarded = [];

    //Timestampler olmasın
    public $timestamps = false;

}