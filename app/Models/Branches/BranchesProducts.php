<?php

namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchesProducts extends Model
{
    use HasFactory;
    protected $table = 'branches_products';
    protected $fillable = [
        'branch_id',
        'product_id',
        'amount'
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Products\Products', 'id', 'product_id');

    }
    public function branch()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_id');

    }
}
