<?php

namespace App\Models\Branches;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchesProductsSelling extends Model
{
    use HasFactory;
    protected $table = 'branches_products_sellings';
    protected $fillable = ['branch_id','product_id','selling'];
}
