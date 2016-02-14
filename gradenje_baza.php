<?php

//creating table
Route::get('create_users_table', function(){
    Schema::create(users, function($table)
    {
        $table->increments(id);
  });
});


//rename
Schema::rename($previousName, $newName);

//drop the table from database
Schema::drop($tableName);

//creating new table-books and adding columns(id, title, pages count, price, dexcription)
Schema::create('books', function(Blueprint $table)
{
    $table->increments('id');
    $table->string('title');
    $table->integer('pages_count');
    $table->decimal('price', 5, 2);
    $table->text('description');
    $table->timestamps();
    $table->softDeletes();
    $table->rememberToken();
});
?>

//migrations
<?php
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Database\Migrations\Migration;
   class PublishersUpdate extends Migration {
       public function up()
       {
           Schema::create('publishers', function(Blueprint $table)
           {
               $table->increments('id');
               $table->string('name');
               $table->timestamps();
           });
           Schema::table('books', function(Blueprint $table)
           {
               $table->integer('publisher_id')->unsigned();
               $table->foreign('publisher_id')->references(
                   'id')->on('publishers');
           });
       }
       public function down()
       {
           Schema::table('books', function(Blueprint $table)
           {
               $table->dropForeign('books_publisher_id_foreign');
               $table->dropColumn('publisher_id');
           });
           Schema::drop('publishers');
       }
   }

?>






