<?php

use Illuminate\Database\Seeder;
use App\Models\CustomerModel as Model;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Model::class, 100)->create();
    }
}
