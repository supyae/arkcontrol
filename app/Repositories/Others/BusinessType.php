<?php

namespace App\Repositories\Others;

use App\Repositories\Client\Client;
use Illuminate\Database\Eloquent\Model;

class BusinessType extends Model
{
    protected $fillable=['name', 'description'];

    protected $table='business_type';

    public function client() {
        return $this->hasMany(Client::class, 'business_id');
    }
}