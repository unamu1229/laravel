<?php


namespace Package\HowToUse\Domain\Model;

use Package\HowToUse\Domain\UseCase\KakuyasuSimInterface;

class Mineo implements KakuyasuSimInterface
{
    private $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage->storage;
    }

    public function price()
    {

        if($this->storage == '1GB'){
            return '初年度 980円';
        }

        return '初年度 4000円';
    }
}