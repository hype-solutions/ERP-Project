<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ERPLog extends Model
{
    use HasFactory;
    protected $table = 'erp_log';
    protected $fillable = [
        'type',
        'action',
        'custom_id',
        'user_id',
        'action_date',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
