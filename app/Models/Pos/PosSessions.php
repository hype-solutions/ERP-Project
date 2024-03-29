<?php

namespace App\Models\Pos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSessions extends Model
{
    use HasFactory;
    protected $table = 'pos_sessions';
    protected $fillable = [
        'branch_id',
        'customer_id',
        'status',
        'total',
        'cost',
        'discount_amount',
        'discount_percentage',
        'tax',
        'delivery',
        'open_by',
        'sold_by',
        'refunded_by',
        'full_refund',
        'sold_when',
        'refunded_when',
    ];

    public function open_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'open_by');
    }
    public function sell_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'sold_by');
    }
    public function refund_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'refunded_by');
    }

    public function branch()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_id');
    }
    public function customer()
    {
        return $this->hasOne('App\Models\Customers\Customers', 'id', 'customer_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Models\Pos\Cart', 'pos_session_id', 'id');
    }


}
