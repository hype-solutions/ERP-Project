<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomersController extends Controller
{
    protected function validateRequest()
    {
        return request()->validate([
            'customer_name' => 'required|max:255',
            'customer_mobile' => 'required|unique:customers',
        ]);
    }
    public function store()
    {
        Customers::create($this->validateRequest());
    }

    public function update(Customers $customer)
    {
        $customer->update($this->validateRequest());
    }
}
