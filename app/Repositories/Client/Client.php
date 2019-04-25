<?php

namespace App\Repositories\Client;

use App\Repositories\Others\BusinessType;
use App\Repositories\Others\Country;
use App\Repositories\Others\DeploymentSite;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable=[
        'name',
        'address',
        'contact_person_name',
        'contact_person_phone',
        'contact_person_email',
        'total_mf_subscription',
        'country_id',
        'business_id',
        'deployment_id'
    ];

    protected $table='client';

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function business_type() {
        return $this->belongsTo(BusinessType::class, 'business_id');
    }

    public function deployment_site() {
        return $this->belongsTo(DeploymentSite::class, 'deployment_id');
    }
}
