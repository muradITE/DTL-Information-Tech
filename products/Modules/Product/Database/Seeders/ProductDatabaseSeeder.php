<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Person\Entities\Person;
use Modules\Product\Entities\Product;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Product::factory()
            ->count(10)
            ->for(Person::factory()->create())
            ->create();

        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
