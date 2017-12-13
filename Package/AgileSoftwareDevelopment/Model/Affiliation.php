<?php


namespace Package\AgileSoftwareDevelopment\Model;


interface Affiliation
{
    public function getServiceCharge($date);

    public function calculateDeductions($pc);
}