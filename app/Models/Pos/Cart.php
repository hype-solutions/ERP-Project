<?php

namespace App\Models\Pos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'pos_session_id',
        'product_id',
        'product_name',
        'product_qty',
        'product_price',
        'included_by',
        'added_at',
    ];
}
