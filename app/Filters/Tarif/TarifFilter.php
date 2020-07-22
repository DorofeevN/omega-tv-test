<?php

// ProductFilter.php

namespace App\Filters\Tarif;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Tarif\Miscellaneous\CompanyIdFilter;

class TarifFilter extends AbstractFilter
{
    protected $filters = [
        'company_id' => CompanyIdFilter::class,
    ];
}
