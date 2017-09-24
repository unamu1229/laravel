<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Package\HowToUse\Repository\BookRepository;

class BookTest extends TestCase
{

    public function testBookAuthor()
    {
        $book = Book::first();
        $this->assertEquals($book->name, 'ワンピース');
        $this->assertEquals($book->author->name, '尾田');



        $bookRepository = $this->app->make(BookRepository::class);
        $book = $bookRepository->getBook();

        $books = $book->whereHas('author', function($query){
            $query->where('active', 0);
        })->get();
        foreach($books as $book){
            $this->assertEquals($book->name, 'ハンターハンター');
            $this->assertEquals($book->author->name, '富樫');
        }

        $this->assertEquals(
            $book->whereHas('author', function($query){
                $query->where('active', 0);
            })->toSql(),
            "select * from `book` where exists (select * from `author` where `book`.`author_id` = `author`.`id` and `active` = ?)"
        );

        foreach($book->get() as $book){
            $authorsActive = $book->author()->where('active', 0)->get();
            foreach($authorsActive as $authorActive){
                $this->assertEquals($book->name, 'ハンターハンター');
                $this->assertEquals($authorActive->name, '富樫');
            }
        }



        $book->where('author_id', 2);
        // App/Bookは、上記のwhere句の状態を保持しない
        $this->assertEquals($book->toSql(), "select * from `book`");

        // App/Bookからのwhere句の返り値で、クエリーの状態を保持する Illuminate\Database\Eloquent\Builderを返す。
        $book = $book->where('author_id', 2);
        // Illuminate\Database\Eloquent\Builder なので返り値を変数で受けなくても、下記Where句のクエリーの状態を保持する。
        $book->where('name', 'ハンターハンター');
        $this->assertEquals($book->toSql(), "select * from `book` where `author_id` = ? and `name` = ?");



        $bookStatic = $bookRepository->getEloquentBuilder();
        $bookStatic->where('author_id', 2);
        $this->assertEquals($bookStatic->toSql(), "select * from `book` where `author_id` = ?");

    }
}
