<?php

namespace App\Models\Out;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutEntities extends Model
{
    use HasFactory;
    protected $table = 'out_entities';
    protected $fillable = [
        'entity_name',
    ];
}
