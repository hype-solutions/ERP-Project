<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    use HasFactory;
    protected $table = 'config';
    protected $fillable = [
        'installed',
        'installed_at',
        'owner_name',
        'owner_mobile',
        'purchase_date',
        'renewal_status',
        'next_renewal_date',
        'licence_key',
    ];
}
