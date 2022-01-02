<?php

namespace App\Models\Pos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosRefunds extends Model
{
    use HasFactory;
    protected $table = 'pos_refunds';
    protected $fillable = [
        'pos_session_id',
        'full_refund',
        'branch_id',
        'customer_id',
        'total_before',
        'total_after',
        'discount_amount',
        'discount_percentage',
        'tax',
        'delivery',
        'refunded_by',
        'refunded_when',
    ];
}
