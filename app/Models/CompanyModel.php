<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $table = 'companies';
    public $timestamps = false;

    public function tarifs()
    {
        return $this->hasMany(TarifModel::class,'company_id');
    }

    // public function customers(){
    //   eturn $this->hasManyThrough(CustomerModel::class, CustomerModel::class);
    // }

    // public function active_tarifs()
    // {
    //     //return $this->hasMany(TarifModel::class, 'company_id');
    //     return $this->hasMany(TarifModel::class,'company_id');
    // }


}
