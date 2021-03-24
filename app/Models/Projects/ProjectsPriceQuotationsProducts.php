<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsPriceQuotationsProducts extends Model
{
    use HasFactory;
    protected $table = 'projects_price_quotations_products';
    protected $fillable = [
        'project_id',
        'customer_id',
        'product_id',
        'product_temp',
        'product_desc',
        'product_price',
        'product_qty',
        'status',
    ];
    public function product()
    {
        return $this->hasOne('App\Models\Products\Products', 'id', 'product_id');
    }
}

