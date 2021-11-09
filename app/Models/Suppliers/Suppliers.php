<?php

namespace App\Models\Suppliers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable =
    [
        'supplier_name',
        'supplier_mobile',
        'supplier_phone',
        'supplier_company',
        'supplier_email',
        'supplier_address',
        'supplier_notes',
        'supplier_commercial_registry',
        'supplier_tax_card',
    ];
}
