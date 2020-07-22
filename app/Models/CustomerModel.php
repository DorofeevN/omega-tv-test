<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

//!
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Customer\CustomerFilter;

class CustomerModel extends Model
{
    protected $table = 'customers';
    public $timestamps = false;

    public function scopeFilter(Builder $builder, $request)
    {
      return (new CustomerFilter($request))->filter($builder);
    }

    public function tarifs()
    {
        return $this->belongsToMany(TarifModel::class, 'customers_tarifs', 'customer_id', 'tarif_id');
    }

    public function active_tarifs()
    {
        return $this->belongsToMany(TarifModel::class, 'customers_tarifs', 'customer_id', 'tarif_id')->wherePivot('active', 1);
    }

    public function is_active($tarif_id){
      return $this->belongsToMany(TarifModel::class, 'customers_tarifs', 'customer_id', 'tarif_id')->wherePivot('active', 1)->wherePivot('tarif_id', $tarif_id);
    }

    // public function obtains_tarif()
    // {
    //   return $this->belongsToMany(TarifModel::class, 'customers_tarifs', 'customer_id', 'tarif_id')->where('customer_id','=',$this->id);
    // }


}
