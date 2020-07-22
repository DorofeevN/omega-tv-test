<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//!--!//
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Tarif\TarifFilter;

class TarifModel extends Model
{
    protected $table = 'tarifs';
    public $timestamps = false;

    public function scopeFilter(Builder $builder, $request)
    {
      return (new TarifFilter($request))->filter($builder);
    }

    public function company()
    {
      return $this->belongsTo(CompanyModel::class);
    }

    public function customers()
    {
        return $this->belongsToMany(CustomerModel::class, 'customers_tarifs', 'tarif_id', 'customer_id');
    }

    public function active_customers()
    {
        return $this->belongsToMany(CustomerModel::class, 'customers_tarifs', 'tarif_id', 'customer_id')->where('active','=',true);
    }
    //
    public function isactive()
    {
      if($this->active_customers()->exists('id', $this->id)) return true;
      return false;
    }
}
