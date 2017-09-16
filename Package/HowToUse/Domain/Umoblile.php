<?php


namespace Package\HowToUse\Domain;


class Umoblile implements KakuyasuSimInterface
{
    private $storage;

    public function __construct($storage)
    {
        $this->storage = $storage;
    }

    public function price()
    {

        if($this->storage == '1GB'){
            return '880円';
        }

        if($this->storage == '2GB'){
            return '1680円';
        }

        return '4900円';
    }
}