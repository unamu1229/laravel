<?php


namespace Package\HowToUse\Repository;

use App\Book;
use Package\HowToUse\Domain\Model\ValueObject\UpdateBookNameData;

class BookRepository
{

    /*
     * App/Book
     * DI直後はクエリーの状態を保持しない。
     * クエリビルダーのメソッドの返り値でクエリーの状態を保持した Illuminate\Database\Eloquent\Builderを返す。
     */
    private $book;

    /*
     * Illuminate\Database\Eloquent\Builder
     * クエリビルダーのメソッドの返り値の為、クエリーの状態を保持する。
     */
    private $eloquentBuilder;

    public function __construct(Book $book)
    {

        $this->book = $book;

        $this->eloquentBuilder = Book::select('*');

    }

    public function getBook()
    {
        return $this->book;
    }

    public function getEloquentBuilder()
    {
        return $this->eloquentBuilder;
    }

    public function updateBookName(UpdateBookNameData $updateBookNameData)
    {
        $this->book->where('id', $updateBookNameData->getId())->update(['name' => $updateBookNameData->getName()]);
    }

}