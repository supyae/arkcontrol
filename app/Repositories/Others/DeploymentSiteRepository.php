<?php
namespace App\Repositories\Others;


use App\Repositories\GeneralRepository;

class DeploymentSiteRepository extends GeneralRepository
{
    public function __construct()
    {
        parent::__construct(new DeploymentSite());
    }
}