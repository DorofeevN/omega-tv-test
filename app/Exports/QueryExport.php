<?php

namespace App\Exports;

use App\Models\CustomerModel;
use Maatwebsite\Excel\Concerns\FromArray;

class QueryExport implements FromArray
{
  protected $invoices;

   public function __construct(array $invoices)
   {
       $this->invoices = $invoices;
   }

   public function array(): array
   {
       return $this->invoices;
   }
}
