<?php

namespace Modules\Person\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Entities\Product;

class Person extends Model
{
//    protected $table = 'persons';
    public $timestamps = false;
    protected $primaryKey = 'person_id';

    protected $fillable = ["full_name", "email"];

    public function product()
    {
        return $this->hasMany(Product::class);
    }


    use HasFactory;

    protected static function newFactory()
    {
        return \Modules\Person\Database\factories\PersonFactory::new();
    }
}
