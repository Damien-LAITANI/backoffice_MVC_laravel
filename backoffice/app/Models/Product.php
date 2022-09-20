<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Type;

class Product extends Model
{
    /**
     * Le nom de la table
     *
     * @var string
     */
    protected $table = 'product';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'product_has_tag');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
