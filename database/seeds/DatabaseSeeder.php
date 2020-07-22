<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $this->call(CompanySeeder::class);
      $this->call(TarifSeeder::class);
      $this->call(CustomerSeeder::class);
      $this->call(CustomerTarifSeeder::class);

      Schema::table('tarifs', function($table) {
        $table->foreign('company_id')->references('id')->on('companies');
      });

      Schema::table('customers_tarifs', function($table) {
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->foreign('tarif_id')->references('id')->on('tarifs');
      });
    }
}
