<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductsCategories extends Model
{
    use HasFactory;
    protected $table = 'products_categories';
    protected $fillable = ['cat_name'];


    public function product()
    {
        return $this->hasMany('App\Models\Products\Products', 'procuct_category', 'id');
    }
}
