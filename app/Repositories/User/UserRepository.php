<?php

namespace App\Repositories\User;

use App\Repositories\GeneralRepository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new User());
    }

}