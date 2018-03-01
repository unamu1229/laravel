<?php


namespace tests\HowToUse;


use Tests\TestCase;

class IteratorAggregateTest extends TestCase
{
    const NAME = 'yoneda';
    const TEL = '989777666';
    const ADDRESS = '東淀川区';
    const FAVORITE_FOODS = ['カレー', 'ラーメン'];

    public function testNotIterator()
    {
        $human = new class {
            public $name = IteratorAggregateTest::NAME;
            public $tel = IteratorAggregateTest::TEL;
            private $address = IteratorAggregateTest::ADDRESS;
        };

        foreach ($human as $key => $val) {
            if($key == 'name') {
                $this->assertEquals($val, self::NAME);
                continue;
            }
            if($key == 'tel') {
                $this->assertEquals($val, self::TEL);
                continue;
            }
            if($key == 'address') {
                // privateのプロパティはループでアクセスできません。
                // $this->assertEquals($val, self::ADDRESS);
                continue;
            }
        }
    }

    public function testIteratorAccessPrivateProperty()
    {
        $human = new class implements \IteratorAggregate {
            private $name = IteratorAggregateTest::NAME;
            private $tel = IteratorAggregateTest::TEL;
            private $address = IteratorAggregateTest::ADDRESS;

            /**
             * @return \ArrayIterator
             */
            public function getIterator()
            {
                // foreachでこのメソッドが自動で呼ばれるので、イテレーターを作成して返す。返り値はイテレーターで無ければエラーになる。
                return new \ArrayIterator(['name' => $this->name, 'tel' => $this->tel, 'address' => $this->address]);
            }
        };

        // 暗黙的にgetIteratorがよばれる。
        foreach ($human as $key => $val) {
            if ($key == 'name') {
                $this->assertEquals(self::NAME, $val);
                continue;
            }
            if ($key == 'tel') {
                $this->assertEquals(self::TEL, $val);
                continue;
            }
            if ($key == 'address') {
                $this->assertEquals(self::ADDRESS, $val);
                continue;
            }
        }

        // 明示的にgetIteratorを読んでArrayIteratorを取得してもOK
        $humanIterator = $human->getIterator();
        $humanIterator->ksort();
        $i = 0;
        foreach ($humanIterator as $key => $val) {
            $i += 1;
            if ($key == 'address') {
                $this->assertEquals(1, $i);
            }
        }

    }


    public function testIteratorYield()
    {
        $foods = new class implements \IteratorAggregate {
            public $favoriteFoods = IteratorAggregateTest::FAVORITE_FOODS;

            public function getIterator()
            {
                foreach ($this->favoriteFoods as $favariteFood) {
                    yield $favariteFood;
                }
            }
        };

        foreach ($foods as $key => $val) {
            if ($key == 0) {
                $this->assertEquals('カレー', $val);
                continue;
            }
            if ($key == 1) {
                $this->assertEquals('ラーメン', $val);
                continue;
            }
        }

    }
}