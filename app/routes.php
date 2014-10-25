<?php

/**
 * Crud Route'ları
*/

//Yeni bir kategori oluşturalım
Route::get('kategoriyap', function(){

    //Active Record achitecture'u ile yeni bir kategori oluşturalım
    $category       = new Category();
    $category->title    = 'Active Record Kategori';
    $category->save();

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());

});

//Create metodu ile bir kategori oluşturalım
Route::get('kategoriyap2', function(){

    //Eloquent'in create() metodunu kullanarak yen,i bir kategori oluşturalım
    $create = Category::create([
        'title' => 'Kategori Create Metodu ile',
    ]);

    //Atanan değişkeni geri döndürelim
    return var_dump($create);

});

//Kategori Güncelle
Route::get('kagegoriguncelle', function(){
    //ID si 1 olan kategoriyi bul ya da exception throwla
    $category = Category::findOrFail(1);

    $category->update([
        'title' => 'Güncellenen Kategori',
    ]);

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});


//Tüm kategorileri bul
Route::get('tumkategoriler', function(){

    //Önce tüm kategorileri bulalım
    $cateories = Category::all();

    echo '<h3>'.$cateories->count().' adet kategori bulundu</h3>';

    //Şimdi de döndürüp title larını echolayalım
    foreach ($categories as $category) {
        echo $category->title;
    }

    echo '<hr />';
    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});



//Filtreleme yap
Route::get('kategorifiltrele', function(){

    //title'ı "Kategori Create Metodu ile" olan kategoriler. Magic method
    $arama = Category::whereTitle('Kategori Create Metodu ile')->get();

    ////title'ı 'a' veya 'b' olanları getir
    //$arama = Category::where('title', 'a')
    //            ->orWhere('title', 'b')
    //            ->get();

    ////Where gruplama
    //$titles    = ['Haberler', 'Genel'];
    //$arama      = Category::where(function($q) use($titles){
    //    $q->where('title', $titles1[0]);
    //    $q->orWhere('title', $titles1[1]);
    //})->orWhere(function($q2){
    //    $q2->where('created_at', '>', '2014-01-01 00:00:00');
    //    $q2->where('title', 'LIKE', 'hibrit');
    //});
    ////Burada "başlığı 'Haberler' veya 'Genel' olan" VEYA "2014 yılında oluşturulmuş ve başlığında 'hibrit' kelimesi geçen" kategorileri getir dedik.

    ////oluşturulma tarihi 2014-01-01 00:00:00'dan büyük olanları getir
    //$arama = Category::where('created_at', '>', '2014-01-01 00:00:00')->get();

    ////title sütunu içinde 'paralel' kelimesi geçenleri filtrele
    //$arama = Category::where('title', 'LIKE', '%paralel%')->get();



    ////tek seferlik başka bir database bağlantısı kullanarak veri alma
    //$usersFromRemote = User::on('uzak-sql')->find(1);

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());

});


/**
 * Crud Route'ları SON
*/


/**
 * Soft Deleteler
*/

//Standart yolla Tüm değerleri alalım (database'de aslında 1 soft delete var)
Route::get('softdelete1', function(){

    $tumBloglar = Blog::all();

    return var_dump($tumBloglar);
});

//Tüm değerleri alalım, içine soft delete değerler de dahil olsun
Route::get('softdelete2', function(){

    //withTrashed() metodu
    $tumBloglar = Blog::withTrashed()->get();

    return var_dump($tumBloglar);
});

//Sadece soft-delete edilmiş değerleri alalım
Route::get('softdelete3', function(){

    //onlytrashed() metodu
    $tumBloglar = Blog::onlyTrashed()->get();

    return var_dump(DB::getQueryLog());
});

//Soft delete tanımlı modelde değer silelim ve tümünü alalım
Route::get('softdelete4', function(){

    //Önce tüm değerleri var_dumplayalım
    var_dump(Blog::all());

    //ID=1 olan blog girdisini silelim
    Blog::find(1)->delete();

    echo '<hr />';

    //Şimdi yine var_dumplayalım
    var_dump(Blog::all());

    echo '<hr />';

    //withTrashed() metodu ile vardumpla şimdi de
    var_dump(Blog::withTrashed()->get());
});

//Silinen veriyi geri döndür
Route::get('softdelete5', function(){

    $blog = Blog::find(1);

    echo $blog ? 'Blog var' : 'Blog yok';

    echo '<hr />';

    //geri döndür
    $blog->restore();

    //Şimdi bir daha bak
    echo 'restore() ile geri döndürüldükten sonra ' . $blog ? 'Blog artık var' : 'blog hala yok';

});

//Soft delete aktifken satırı veritabanından kalıcı olarak siler
Route::get('softdelet6', function(){

    //Önce soft-delete'leri de sayarak veri var mı bakalım
    $blog = Blog::withTrashed()->find(1);

    echo $blog ? 'veri var' : 'veri yok';

    echo '<hr />';

    $blog->forceDelete();

});

/**
 * Soft Deleteler SON
*/


/**
 * Query Scope'lar
*/

//Temel Query Scope Kullanımı
//Modelde scopeYillik() diye bir fonksiyon olmalı
Route::get('queryscope1', function(){
    $yillikBloglar = Blog::yillik()->get();
    return var_dump(DB::getQueryLog());
});

//Query Scope'a parametre de gönderebiliyoruz
Route::get('queryscope2', function(){
    $yillikBloglar = Blog::yilinda(2012)->get();

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});

/**
 * Query Scope'lar SON
*/


/**
 * Relationshipler
*/

//One-to-One relationships
Route::get('relationship1', function(){

    //Önce primaryKey'i 1 olan user'ı bulalım 
    $user = User::find(1);

    //Şimdi de meta ilişkisine nesne şeklinde erişelim:
    return $user->meta;

    //Not: Doğrudan return dediğimiz için 
    //Eloquent Collection değil JSON formatı geldi karşımıza
});

//One-to-Many relationship, has many
Route::get('relationship2', function(){

    //Önce tüm kategorileri alalım
    $kategoriler = Category::all();

    //Şimdi de bir loop içinde önce kategorideki blog sayısını, 
    //sonra da blog isimlerini gösterelim
    foreach ($kategoriler as $kategori) {
        //count() metodu kaç adet result olduğunu integer cinsinden verir
        echo '<h3>'.$kategori->title. ' kategorisinde '.$kategori->blogs->count().' adet blog yazısı var</h3>';
        //Şimdi tüm blogları döndürelim
        //NOT: obje adı "blogs", çünkü Category.php modelinde relationship metodunun adına de blogs() dedik
        foreach ($kategori->blogs as $blog) {
            //Alt relationda'da foreach loop'unda sütunlara doğrudan erişebiliyoruz. 
            echo $blog->title;
            echo '<br />';
        }
        echo '<hr />';
    }

});

//One-to-Many relationship, belongs To
Route::get('relationship3', function(){

    //Tüm blogları döndürelim:
    $tumBloglar = Blog::get();

    foreach ($tumBloglar as $blog) {
        echo $blog->title.' başlıklı blog yazısı '.$blog->category->title.' isimli kategoriye bağlı <br />';
    }

});


//Many-to-Many relationship, belongsToMany, Blogdan taga
Route::get('relationship4', function(){

    //Önce bir blog yazısı bulalım
    $blog = Blog::find(2);

    //Şimdi de etiketlerini dökelim:
    return var_dump($blog->tags);

    //Blog yazımızın etiketlerini yakalamış olduk

});

//Many-to-Many relationship, belongsToMany, Tagdan bloğa
Route::get('relationship5', function(){

    //Önce bir "etiket2" adlı etiketi yakalayalım:
    $tag = Tag::whereTag('etiket2')->first();

    //Şimdi de bu etikete bağlı tüm blog yazılarını bulalım 
    return var_dump($tag->blogs);

});

//Many to many relationship, bloğa bir etiket bağlayalım
Route::get('relationship6', function(){

    //id'si 2 olan bloğu bulalım
    $blog = Blog::find(2);

    //bu bloğa id'si 1 olan etiketi bağlayalım
    //NOT, FONKSİYON BURADA, OBJE DEĞİL
    $blog->tags()->attach(1);

    return 'ID\'si 2 olan bloğa ID\'si 1 olan etiket bağlandı.';

});


//Many to many relationship, bloktan bir etiketi kaldır
Route::get('relationship7', function(){

    //id'si 1 olan bloğu bulalım
    $blog = Blog::find(1);

    //bu bloktan id'si 2 olan (tags tablosundaki id sütunu) etiketi çıkaralım
    //NOT, FONKSİYON BURADA, OBJE DEĞİL
    $blog->tags()->detach(2);

    return 'ID\'si 1 olan bloktan ID\'si 2 olan etiket çıkarıldı.';

});

//Many to many relationship, bir etiketi tüm blok yazılarından kaldırma
Route::get('relationship8', function(){

    //id'si 3 olan etiketi bulalım
    $tag = Tag::find(3)
        //böyle chain de yapabiliyoruz
        //Ardından bu etiketten blokla alakalı tüm relationlaı kaldırıyoruz
        //NOT, FONKSİYON BURADA, OBJE DEĞİL
        ->blogs()
        ->detach();

    return 'ID\'si 3 olan etiketten tüm blok girdileri ayrıldı.';

});

//Many to many relationship, attach'a pivot datası da ekliyoruz
Route::get('relationship9', function(){

    //id'si 3 olan etiketi bulalım
    $tag = Tag::find(3)
        ->blogs()
        ->attach(1, ['random' => 'phpkonf']);

    return 'ID\'si 3 olan etikete ID\'si 1 olan blog yazısı ilişkilendirildi ve "phpkonf" ekstra random verisi eklendi.';

});

//Bloğu olan katerogileri alalım
Route::get('relationshipsorgu1', function(){

    //has('relationAdı')
    $kategoriler = Category::has('blogs')->get();

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});

//En az 2 bloğu olan katerogileri alalım
Route::get('relationshipsorgu2', function(){

    //has('relationAdı', ...)
    $kategoriler = Category::has('blogs', '>=', 2)->get();

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});

//İlişkiyi koşullarımızla filtreleyerek ana sorguyu kısıtlayalım
Route::get('relationshipsorgu3', function(){

    //Bu yıl yayımlanmış en az 1 bloğu olan kategorileri alalım
    $kategoriler = Category::whereHas('blogs', function($query){
        $query->where('created_at', 'LIKE', date('Y').'-%');
    })->get();

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});

//İlişkiyi koşullarımızla filtreleyerek ana sorguyu kısıtlayalım
Route::get('relationshipsorgu4', function(){

    //Closure içine bir closure daha açarak sorgu daha da derinleşebilir:
    $etiketler = Tag::whereHas('blogs', function($q){

        $q->whereHas('category', function($q2){
            $q2->where('title', 'Kategori1');
        });
    
    })->get();

    //Soft delete'lere de sadık kalacak, dikkat!

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());
});


/**
 * Relationshipler SON
*/

/**
 * Eager Loading Başla
*/

//Eager Loading
Route::get('eagerloading1', function(){

    //Tüm blogları etiketleri ile alalım
    $blogVeEtiketler = Blog::with('tags')->get();

    //Eğer loop etseydik her loop verisi için Eloquent arkada yeniden sorgu atacaktı
    //Burada iki koleksiyonu alıp match edenlerle birleştiriyoruz
    //Sayfa başına 10 blog entrysi için 11 (1+10) (n+1) olacakken 
    //X tanesi için 2 tane sorgu ile hallediyoruz

    //return $blogVeEtiketler;

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());

});

//Eager Loading Nesting (iç içe geçme)
Route::get('eagerloading2', function(){

    //Tüm kategori, blog ve etiketleri alalım
    $kategoriBlogVeEtiketler = Category::with('blogs', 'blogs.tags')->get();

    //return $kategoriBlogVeEtiketler;

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());

});

//Eager Loading Nesting (iç içe geçme)
Route::get('eagerloading3', function(){

    //Tüm kategori, blog ve etiketleri alalım, etiketlere filtre yapalım
    $kategoriBlogVeEtiketler = Category::with([
        'blogs' => function($q) {
            $q->where('title', 'Blog Başlığı');
        }, 
        'blogs.tags'
        ])->get();

    //return $kategoriBlogVeEtiketler;

    //Çalıştırılan veritabanı sorgularını geri döndürelim
    return var_dump(DB::getQueryLog());

});

/**
 * Eager Loading SON
*/



//findOrFail() veya firstOrFail() hatalarını yakalama
use Illuminate\Database\Eloquent\ModelNotFoundException;
App::error(function(ModelNotFoundException $e)
{
    return Response::make('Bulunamadi', 404);
});



/////////root page
Route::get('/', function()
{
	return View::make('hello');
});