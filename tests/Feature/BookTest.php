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
        $book = $bookRepository->getEloquent();

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

    }
}
