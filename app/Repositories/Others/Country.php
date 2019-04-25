<?php

namespace App\Repositories\Others;

use App\Repositories\Client\Client;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=['name'];

    protected $table='country';

    public function client() {
        return $this->hasMany(Client::class, 'country_id');
    }

}