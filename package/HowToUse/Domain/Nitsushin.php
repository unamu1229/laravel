<?php

namespace Package\HowToUse\Domain;

class Nitsushin implements InstantNoodleInterface
{

    public $type;

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function name()
    {
        if($this->type == 'うどん'){
            return 'どん兵衛';
        }
        if($this->type == 'ラーメン'){
            return 'カップヌードル';
        }
        return 'UFO';
    }
}