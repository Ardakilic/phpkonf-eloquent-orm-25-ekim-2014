<?php

//Soft Deleting
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Blog extends \Eloquent {

    //Soft Deleting için trait ile kullanıp soft delete sütununu tanımlıyoruz:
    use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    //Hangi sütunlar mass assignment yapılamaz
	protected $guarded = ['id'];

    //Tablo adı ne?
    protected $table = 'blog';


    //Query Scope
    public function scopeYillik($query) {
        return $query->where('created_at', 'LIKE', date('Y').'-%');
    }

    //Dinamik Query Scope
    public function scopeYilinda($query, $yil) {
        return $query->where('created_at', 'LIKE', $yil.'-%');
    }


    //One-to-Many relationship Tanımlama
    //Her bir blog yazısı "bir adet" kategoriye ait. 
    //O zaman Bloglar kategorilere aittir diyebiliriz.
    public function category() {
        return $this->belongsTo('Category', 'categoryId');
    }


    //Many-to-Many Relationship tanımlama
    public function tags() {
        return $this->belongsToMany('Tag', 'blog_tag', 'blog_id', 'tag_id')
            ->withPivot('random');
    }


}