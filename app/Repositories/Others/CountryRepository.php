<?php

namespace App\Repositories\Others;

use App\Repositories\GeneralRepository;

class CountryRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new Country());
    }

}