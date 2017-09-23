<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{

    public function testBookAuthor()
    {
        $book = Book::first();

        echo $book->name . "\n";
        echo $book->author->name . "\n";

        $this->assertTrue(true);
    }
}
