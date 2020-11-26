<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafesTransfers extends Model
{
    use HasFactory;
    protected $table = 'safes_transfers';
    protected $fillable = [
        'safe_from',
        'transfer_amount',
        'amount_before_transfer_from',
        'amount_after_transfer_from',
        'safe_to',
        'amount_before_transfer_to',
        'amount_after_transfer_to',
        'transfer_datetime',
        'transfer_notes',
        'transfered_by',
        'authorized_by',

    ];


    public function safeFrom()
    {
        return $this->hasOne('App\Models\Safes', 'id', 'safe_from');
    }

    public function safeTo()
    {
        return $this->hasOne('App\Models\Safes', 'id', 'safe_to');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'transfered_by');
    }
}
