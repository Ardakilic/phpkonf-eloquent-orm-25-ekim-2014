<?php

Class Tag extends \Eloquent {

    
    //bu tabloda created_at, updated_at sütunları doldurulsun mu?
    public $timestamps = false;

    //Blog modeli ile Many-to-Many relationship
    public function blogs() {
        return $this->belongsToMany('Blog', 'blog_tag', 'tag_id', 'blog_id')
            ->withPivot('random');
    }

}