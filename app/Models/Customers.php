<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = ['customer_name','customer_title','customer_company','customer_mobile','customer_phone','customer_email','customer_address'];

}
