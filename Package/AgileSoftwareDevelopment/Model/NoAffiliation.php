<?php


namespace Package\AgileSoftwareDevelopment\Model;


class NoAffiliation implements Affiliation
{
    public function getServiceCharge($date)
    {
        return 0;
    }

    public function calculateDeductions($pc)
    {
        return 0;
    }
}