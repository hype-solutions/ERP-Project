<?php

namespace App\Models\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigLanguages extends Model
{
    use HasFactory;
    protected $table = 'config_languages';
    protected $fillable = [
        'title',
        'direction',
        'flag',
        'used',
    ];
}
