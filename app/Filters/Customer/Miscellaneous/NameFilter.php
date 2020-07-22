<?php

// TypeFilter.php

namespace App\Filters\Customer\Miscellaneous;

class NameFilter
{
  public function filter($builder, $value)
  {
      return $builder->where('name', $value)->orderBy('id', 'desc');
  }
}
