<?php


namespace tests\HowToUse;

use App\Book;
use Package\HowToUse\Domain\Model\ValueObject\UpdateBookNameData;
use Package\HowToUse\Repository\BookRepository;
use Tests\TestCase;

class BoolRepositoryTest extends TestCase
{
    public function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function tearDown()
    {
        Book::where('id', 1)->update(['name' => 'ワンピース']);
        parent::tearDown(); // TODO: Change the autogenerated stub
    }

    public function testUpdateName()
    {
        $upDateBookNameData = new UpdateBookNameData('1', 'ドラゴンボール');
        $bookRepository = $this->app->make(BookRepository::class);
        $bookRepository->upDateBookName($upDateBookNameData);
        $this->assertEquals('ドラゴンボール', Book::where('id', 1)->value('name'));
    }

}