<?php
//Osnovni operacii so kolekcii

//conatins()
$books = \App\Book::all();
if($books->contains(3))
{
    return 'yeah, book 3 is here!';
}


//get()
$book = $books->get(2);
//preddefinirana vrednost dokolku elementot ne postoi:
$book = $books->get(2, "Not Found!");

//put()
$books->put(2, $book);

//modelKeys()
$books = \App\Book::all(); $primaryKeys = $books->modelKeys();

//where()
$books = \App\Book::all();
$book = $categories->where('year', 1876)->where('page_count', 254);


//izminuvanje na kolekcii

//each()
$books = \App\Book::all();
$books->each(function($book)
{
    echo $book->title;
});


//filter()
$books = \App\Book:all();
$books->filter(function($book)
{
    if($book->year > 1840)
        return true;
    else
        return false;
});



//sortBy(), sortByDesc()
// ordering books by title, ascending
$books = $books->sortBy(function($book)
{
    return $book->title;
});
// ordering books by creation date, descending;
$books = $books->sortByDesc(function($book)
{
    return $book->created_at;
});

