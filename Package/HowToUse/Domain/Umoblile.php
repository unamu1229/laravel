<?php


namespace Package\HowToUse\Domain;


class Umoblile implements KakuyasuSimInterface
{
    private $storage;
    private $conditions;
    private $netWork;
    private $area;

    public function __construct(Storage $storage, Network $network, $conditions, $area)
    {
        $this->storage = $storage->storage;
        $this->conditions = $conditions;
        $this->netWork = $network->carrier;
        $this->area = $area;
    }

    public function price()
    {
        $content = $this->netWork . $this->area . $this->conditions . $this->storage;

        if($this->storage == '1GB'){
            $content .= '880円';
        }
        elseif($this->storage == '2GB'){
            $content .= '1680円';
        }
        else{
            $content .= '4900円';
        }

        return $content;
    }
}