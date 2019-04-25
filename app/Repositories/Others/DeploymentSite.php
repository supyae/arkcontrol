<?php
namespace App\Repositories\Others;

use App\Repositories\Client\Client;
use Illuminate\Database\Eloquent\Model;

class DeploymentSite extends Model
{
    protected $fillable=['name', 'description'];

    protected $table='deployment_site';

    public function client() {
        return $this->hasMany(Client::class, 'deployment_id');
    }

}