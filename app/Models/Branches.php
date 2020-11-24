<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branches extends Model
{
    use HasFactory;
    protected $table = 'branches';
    protected $fillable = [
        'branch_name',
        'branch_phone',
        'branch_mobile',
        'branch_address',
        'branch_email',
    ];
}
