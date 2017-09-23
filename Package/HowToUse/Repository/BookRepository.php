<?php


namespace Package\HowToUse\Repository;

use App\Book;

class BookRepository
{

    private $eloquent;

    public function __construct(Book $book)
    {
        $this->eloquent = $book;
    }

    public function getEloquent()
    {
        return $this->eloquent;
    }

}