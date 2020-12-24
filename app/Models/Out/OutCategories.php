<?php

namespace App\Models\Out;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutCategories extends Model
{
    use HasFactory;
    protected $table = 'out_categories';
    protected $fillable = [
        'category_name',
    ];
}
