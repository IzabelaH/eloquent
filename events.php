<?php
/**
 * Created by PhpStorm.
 * User: User_I
 * Date: 10.2.2016
 * Time: 00:20
 */

//Modal Events se isplauvaat koga odredeno nesto ke se sluci vo zivotniot ciklus na modelot (creating, created, updating, updated, saving, saved, deleting, deleted, restoring, restored)
//kreiranje na nastani se pravi vo EventServiceProvider klasata kade se dodavaat posebni event listeneri za koj sakame da dodademe nastan
// ova se pisuva vo boot metodot na klasata
public function boot() {
    User::created(function($user)
    {
    // doing something here, after User creation...
    });
}
//moze ovie akcii da se zaprat so dodavanje na fakse vrednost na creating, updating, saving, restoring, deleting metodite
User::creating(function($user){
    if(ends_with($user->email, '@forbidden.com')) {
        return false;
    }
});

//dokolku sakame da imame klasa koja e se spravuva so site nastani vo aplikacijata kreirame EventObserver
//ova e vsusnot ponapredna verzija na samite nastani, a se pravi na mn slicen nacin
class BookObserver { public function creating($book)
{
    // do things before creating a book
} public function saving($book) {
// do things before saving a book }
}
//pritoa klasata mora da se registrira vo EventServiceProvider klasta na sledniot nacin
Book::observe(new BookObserver);

