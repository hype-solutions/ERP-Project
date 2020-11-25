<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsManualQuantities extends Model
{
    use HasFactory;
    protected $table = 'products_manual_quantities';
    protected $fillable = [
        'product_id',
        'qty',
        'branch_id',
        'qty_before_add',
        'qty_after_add',
        'qty_price',
        'qty_datetime',
        'qty_notes',
        'added_by',
        'authorized_by',

    ];
}
