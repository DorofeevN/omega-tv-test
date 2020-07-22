<?php

use Illuminate\Database\Seeder;
use App\Models\CompanyModel as Model;
class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Model::class, 20)->create();
    }
}
