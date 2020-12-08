<?php

namespace App\Models\Safes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafesTransactions extends Model
{
    use HasFactory;
    protected $table ='safes_transactions';
    protected $fillable = [
        'safe_id',
        'transaction_type',
        'transaction_amount',
        'transaction_notes',
        'transaction_datetime',
        'done_by',
        'authorized_by',
    ];
}

