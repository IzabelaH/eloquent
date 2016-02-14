<?php
/**
 * Created by PhpStorm.
 * User: User_I
 * Date: 05.2.2016
 * Time: 22:21
 */

// kreiranje na model se pravi so komandata
//  php artisan make:model <Name>
//pri sto se kreira model koj ja nasleduva klasata Illuminate\Database\Eloquent\Model i izgleda vaka:

namespace App;
use Illuminate\Database\Eloquent\Model;
class Book extends Model
{
}

//ako sakame da specificirame na koja tabela se odnesuva modelot go pravime na sledniot nacin
class Book extends Model
{
    protected $table = 'Kniga';
}

//zapis vo tabela se kreira so kontroler na sledniot nacin
class BookController extends Controller
{
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = 'My Book';
        $book->pages = 50;
        $book->price = 250;
        $book->save();
    }
}


//ako sakame da gi procitame site zapisi od tablela ja koristime slednava komanda
public function get_all_books(Request $request)
{
    return \App\Book::all();
};

//za prebaruvanje  so uslov se koristi where
public function get_books(Request $request)
{
    $result = \App\Book::where('price', '<', 1000)->get();
    return $result;
};

//namesto poveke moze da pobarame i samo eden zapis koj ispolnuva odreden uslov

$result= \App\Book::where('price','<',1000)-> where('title', '=', 'My Book')->get();

//za manuvanje na zapis vo baza potrebno e prethodno istiot da se pronajde i potoa mu se dodeluva nova vrednost
// vsusnot e kombinacija od naoganje i dodeluvanje na vrednost za zapis
$book = \App\Book::find(1);
$book->title = 'My Updated Book!';
$book->save();

//brisenjeto e mnogu ednostavno samo so povikuvanje na metodata za brisenje
\App\Book::find(1)->delete();

//prebaruvanje na zapis koj isolnuva eden uslov od navedenite
public function get_books-îr (Request $request) {
    $results = \App\Book::where('title', 'LIKE', '%Book%')->orWhere('pages', '>', 100)->get();
    return $results;

};

//so kombinacii moze da se kreiraat i poslozeni uslovi
$results = \App\Book::where(function($query){
    $query
        ->where('pages','>',100)->where('title','LIKE', '%Book%');
})->orWhere(function($query){
    $query
        ->where('pages','<',50)->orWhere('price','>','200');
})->get();


//za naoganje na vrednosti od odreden rang se koristi whereBetween()
$results = \App\Book::whereBetween('pages_count',[100, 200])
    ->get();
//naoganje na zapisi dali postojat vo odredeno pole
$results = \App\Book::whereBetween('pages_count',[100, 200]) ->get();

//proverka dali odreden zapis postoi
$DontExist = \App\Book::whereNull('title')->get();

//agregatni funkcii
$booksCount = \App\Book::where('pages', '>',150)->count();

$avgPrice = \App\Book::where('title', 'LIKE','%Book%')
    ->avg('price');

// orderBy
\App\Book::orderBy('title', 'asc')->get();
// groupBy
\App\Book::groupBy('price')->get();
// having
\App\Book::having('count', '<', 20)->get();

//Mass assignment
//moze da se napravi so model konstruktor so asocijativno pole
$book = new \App\Book([ 'title' => 'Caption', 'pages' => 300,
    'price' => 420 ]);
//ili so staticno povikuvanje na metodot za kreiranje na samiot model
$book = \App\Book::create([ 'title' => 'My Caption', 'price' => 150, 'pages' => 150, ]);
//mozno e da nastane problem dokolku cel request se prati preku post metodot na formata i se resava so polinjata $fillable i $guarded so koi
//specificirame na koi polinja mozeme da dodavame vrednosti a na koi ne na ovoj nacin


//so timestamps se kriraat dve polinja vo tabelata created_at i updated_at, dokolku ne sakame treba da se postavi na false ova pole
class Book extends Model {
    public $timestamps = false;
}

//softDeleting sluzi dokolku sakame da nemame realno brisenje na zapisite tuku da se oznacuvaat kako izbrisani
Schema::create('books', function(Blueprint $table)
{
// other fields...
    $table->softDeletes();
});
//potoa se dodava i vo modelot
class Book extends Model {
    use SoftDeletes;
    protected $dates = ['deleted_at'];}
// so ova imame moznost da gi vidime site osven izbrisanite
$orders = \App\Order::orderBy('created_at', 'desc')->get();
//samo izbrisanite
$trashedOrders=\App\Order::onlyTrashed()-> orderBy('created_at','desc')->get();
//ili pak site zaedno
$orders=\App\Order::withTrashed()->orderBy('created_at', 'desc')->get();
// za vrakanja na izbrisanite koristime restore()
$trashedOrder = \App\Order::find($trashedOrderId);
$trashedOrder->restore();
// a za trajno brisenje od tabelata
$order = \App\Order::find($orderId);
$order->forceDelete();


//Accessors, mutators se vsusnost getter i setter
public function getTitleAttribute($value)
{
    return ucfirst($value);
}

public function setTitleAttribute($value)
{
    $this->attributes['title'] = strtolower($value);
}







