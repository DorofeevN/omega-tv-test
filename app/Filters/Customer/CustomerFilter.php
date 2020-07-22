<?php

// ProductFilter.php

namespace App\Filters\Customer;

use App\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filters\Customer\Miscellaneous\NameFilter;

class CustomerFilter extends AbstractFilter
{
    protected $filters = [
        'name' => NameFilter::class,
    ];
}
