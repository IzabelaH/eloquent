
<?php
//One-to-One
namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
?>

//One-to-Many
<?php
//hasMany()

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
?>
<?php
//belongsTo()

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * Get the post that owns the comment.
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
?>

//Many-to-Many
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
?>


<?php
//inverzna vrska
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
?>

<?php
//Eager Loading
$books = \App\Book::take(100)->get();
foreach($books as $book)
{
    $author = $book->author;
    echo $author->first_name . ' ' . $author->last_name;
}

$books = \App\Book::with('author')->take(100)->get();
foreach($books as $book) {
    $author = $book->author; echo $author->first_name . ' ' . $author->last_name; }

?>

<?php
//Lazy Eager Loading
$books = Book::all();
// some operations here...
$books->load('author', 'categories');


//vnesuvanje nova kniga na odreden avtor
$author = Author::where('first_name', '=', 'Jules')->where('last_name', '=', 'Verne')->first();
$book = new Book;
$book->title = 'Michael Strogoff';
$book->author_id = $author->id;
$book->save();




