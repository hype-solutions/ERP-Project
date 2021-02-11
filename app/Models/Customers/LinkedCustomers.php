<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedCustomers extends Model
{
    use HasFactory;
    protected $table = 'linked_customers';
    protected $fillable = [
        'parent_customer_id',
        'customer_name',
        'customer_mobile',
    ];
}
