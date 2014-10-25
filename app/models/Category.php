<?php

class Category extends Eloquent {

    //tablo adı nedir?
    protected $table = 'categories';

	protected $fillable = ['title'];

    //bu tabloda created_at, updated_at sütunları doldurulsun mu?
    public $timestamps = false;


    //One-to-Many relationship tanımlaması
    //Bir kategorinin birden fazla blog girdisi olabilir.
    //Yani bir kategoriye birden fazla blog girdisi atanabilir
    public function blogs() {
        return $this->hasMany('Blog', 'categoryId');
    }

}