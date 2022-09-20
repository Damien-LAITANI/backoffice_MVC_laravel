<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    /**
     * Le nom de la table
     *
     * @var string
     */
    protected $table = 'brand';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
