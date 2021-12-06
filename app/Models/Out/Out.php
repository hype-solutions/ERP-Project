<?php

namespace App\Models\Out;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Out extends Model
{
    use HasFactory;
    protected $table = 'outs';
    protected $fillable = [
        'category',
        'entity',
        'amount',
        'notes',
        'safe_id',
        'safe_transaction_id',
        'transaction_datetime',
        'done_by',
        'authorized_by',
        'rejected_by',
    ];
    public function done_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'done_by');
    }
    public function auth_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'authorized_by');
    }
    public function reject_user()
    {
        return $this->hasOne('App\Models\User', 'id', 'rejected_by');
    }
    public function safe()
    {
        return $this->hasOne('App\Models\Safes\Safes', 'id', 'safe_id');
    }
    public function theCategory()
    {
        return $this->hasOne('App\Models\Out\OutCategories', 'id', 'category');
    }
    public function theEntity()
    {
        return $this->hasOne('App\Models\Out\OutEntities', 'id', 'entity');
    }
}
