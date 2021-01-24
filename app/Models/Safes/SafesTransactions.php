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
        'direct',
        'transaction_amount',
        'transaction_notes',
        'transaction_datetime',
        'done_by',
        'authorized_by',
    ];
    public function done_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'done_by');
    }
    public function auth_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'authorized_by');
    }
        public function safe()
    {
        return $this->hasOne('App\Models\Safes\Safes', 'id', 'safe_id');
    }
}

