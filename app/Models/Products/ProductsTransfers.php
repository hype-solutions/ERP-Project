<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsTransfers extends Model
{
    use HasFactory;
    protected $table = 'products_transfers';
    protected $fillable = [
        'product_id',
        'branch_from',
        'transfer_qty',
        'qty_before_transfer_from',
        'qty_after_transfer_from',
        'branch_to',
        'qty_before_transfer_to',
        'qty_after_transfer_to',
        'transfer_datetime',
        'status',
        'transfer_notes',
        'transfered_by',
        'authorized_by',
    ];
    public function branchFrom()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_from');
    }

    public function branchTo()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_to');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Products\Products', 'id', 'product_id');
    }

    public function transferUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'transfered_by');
    }

    public function authUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'authorized_by');
    }
}
