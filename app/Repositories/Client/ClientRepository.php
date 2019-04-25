<?php

namespace App\Repositories\Client;

use App\Repositories\GeneralRepository;

class ClientRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new Client());
    }

}