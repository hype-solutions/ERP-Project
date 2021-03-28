<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsPurchasesOrdersProducts extends Model
{
    use HasFactory;
    protected $table = 'projects_purchases_orders_products';
    protected $fillable = [
        'project_id',
        'supplier_id',
        'product_id',
        'product_desc',
        'product_price',
        'product_qty',
        'status',
    ];
}
