<?php
namespace App\Repositories\Others;

use App\Repositories\GeneralRepository;
use Illuminate\Database\Eloquent\Model;

class BusinessTypeRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new BusinessType());
    }

}