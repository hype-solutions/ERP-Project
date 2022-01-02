<?php

namespace App\Models\Pos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'pos_carts';
    protected $fillable = [
        'pos_session_id',
        'status',
        'product_id',
        'product_name',
        'product_qty',
        'product_price',
        'product_cost',
        'included_by',
        'added_at',
    ];

    public function subTotal($session)
    {
        $subTotal = 0;
        $items = Cart::where('pos_session_id', $session)->where('status','!=',2)->get();
        foreach ($items as $item) {
            $thisTotal = $item->product_price * $item->product_qty;
            $subTotal = $subTotal + $thisTotal;
        }
        return $subTotal;
    }
}
