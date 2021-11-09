<?php

namespace App\Models\Safes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Safes extends Model
{
    use HasFactory;
    protected $table = "safes";
    protected $fillable = [
        'safe_name',
        'safe_balance',
        'branch_id'
    ];
    public function branch()
    {
        return $this->hasOne('App\Models\Branches\Branches', 'id', 'branch_id');
    }


    public function safeBalance($safeId = null)
    {
        $in =  SafesTransactions::where('safe_id', $this->id)
            ->where('transaction_type', 2)
            ->sum('transaction_amount');
        $out =  SafesTransactions::where('safe_id', $this->id)
            ->where('transaction_type', 1)
            ->sum('transaction_amount');
        $sum = $in - $out;
        return $sum;
    }
}
