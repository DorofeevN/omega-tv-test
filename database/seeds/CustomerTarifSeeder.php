<?php

use Illuminate\Database\Seeder;
use App\Models\CustomerTarifModel as Model;

class CustomerTarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Model::class, 500)->create();
    }
}
