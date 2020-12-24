<?php

namespace App\Models\In;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InCategories extends Model
{
    use HasFactory;
    protected $table = 'in_categories';
    protected $fillable = [
        'category_name',
    ];
}
