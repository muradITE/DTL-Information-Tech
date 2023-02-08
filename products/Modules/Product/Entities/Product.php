<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Person\Entities\Person;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["product_id", "name", "price", "status", "type", "person_id"];
    public $timestamps = false;
    protected $primaryKey = 'product_id';

//    public $table = 'persons';

    public function person()
    {
        return $this->belongsTo(Person::class);
    }



    protected static function newFactory()
    {
        return \Modules\Product\Database\factories\ProductFactory::new();
    }
}
