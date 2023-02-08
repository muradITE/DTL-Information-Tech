<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Database\Seeder;
use Modules\Person\Entities\person;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Product\Entities\Product;

class Homepage extends Controller
{
    public function index()
    {
        $count = Product::count();
        if($count==0){
            $ProductDatabaseSeeder = new ProductDatabaseSeeder();
            $ProductDatabaseSeeder->run();
        }

        return view('welcome');
    }
}
