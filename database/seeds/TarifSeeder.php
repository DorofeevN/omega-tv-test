<?php

use Illuminate\Database\Seeder;
use App\Models\TarifModel as Model;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Model::class, 400)->create();
    }
}
