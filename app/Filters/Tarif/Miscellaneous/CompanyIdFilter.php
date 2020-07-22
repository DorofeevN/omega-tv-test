<?php

// TypeFilter.php

namespace App\Filters\Tarif\Miscellaneous;

class CompanyIdFilter
{
  public function filter($builder, $value)
  {
      return $builder->where('company_id', $value);
  }
}
