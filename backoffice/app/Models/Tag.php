<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Tag extends Model
{
    /**
     * Le nom de la table
     *
     * @var string
     */
    protected $table = 'tag';

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
