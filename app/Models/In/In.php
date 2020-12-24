<?php

namespace App\Models\In;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class In extends Model
{
    use HasFactory;
    protected $table = 'ins';
    protected $fillable = [
        'category',
        'amount',
        'notes',
        'safe_id',
        'safe_transaction_id',
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
    public function theCategory()
    {
        return $this->hasOne('App\Models\In\InCategories', 'id', 'category');
    }
}
