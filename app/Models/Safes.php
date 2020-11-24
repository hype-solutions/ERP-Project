<?php

namespace App\Models;

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
}
