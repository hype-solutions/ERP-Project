<?php

namespace App\Models\Safes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalFund extends Model
{
    use HasFactory;
    protected $table = 'external_funds';
    protected $fillable = [
        'safe_id',
        'investor',
        'amount',
        'funding_date',
        'refund_date',
        'paid',
        'notes',
        'done_by',
        'authorized_by',
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'funding_date' => 'datetime',
        'refund_date' => 'datetime',
    ];
}
