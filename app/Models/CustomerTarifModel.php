<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerTarifModel extends Model
{
    protected $table = 'customers_tarifs';
    protected $attributes = [
   'active' => true,
    ];
    public $timestamps = false;
}
