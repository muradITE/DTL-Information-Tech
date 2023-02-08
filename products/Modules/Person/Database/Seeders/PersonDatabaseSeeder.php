<?php

namespace Modules\Person\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Person\Entities\person;

class PersonDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        person::factory()
            ->count(3)
            ->create();


        Model::unguard();

        // $this->call("OthersTableSeeder");
    }
}
