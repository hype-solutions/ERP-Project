<?php

namespace App\Models\Pos;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->hasOne(User::class, 'id', 'open_by');
    }
    public function sell_user()
    {
        return $this->hasOne(User::class, 'id', 'sold_by');
    }
    public function refund_user()
    {
        return $this->hasOne(User::class, 'id', 'refunded_by');
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

    public function mostOrdered()
    {
        //todo cleanup and remove injection
        return DB::select(DB::raw('SELECT product_name, sum(product_qty) as total, count(*) as howManyTiems from pos_carts
            LEFT JOIN pos_sessions ON pos_carts.pos_session_id = pos_sessions.id
            WHERE pos_sessions.customer_id = ' . $this->customer_id . '
            group by product_id
            order by sum(product_qty) DESC
            LIMIT 5'));
    }

    public function lastVisitDate()
    {
        return $this->where('customer_id', $this->customer_id)->pluck('created_at')->first();
    }
}
