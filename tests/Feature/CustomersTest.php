<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customers;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function a_customer_can_be_added_to_the_app()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/customer/add', [
            'customer_name' => 'Customer Name',
            'customer_title' => 'Customer Title',
            'customer_company' => 'Customer Company',
            'customer_mobile' => 'Customer Mobile',
            'customer_phone' => 'Customer Phone',
            'customer_email' => 'Customer Email',
            'customer_address' => 'Customer Address',
            ] );
        $response->assertOk();
        $this->assertCount(1,Customers::all());
    }

    /** @test */
    public function customer_can_be_updated(){
        $this->withoutExceptionHandling();
        $this->post('/customer/add', [
            'customer_name' => 'Customer Name',
            'customer_title' => 'Customer Title',
            'customer_company' => 'Customer Company',
            'customer_mobile' => 'Customer Mobile',
            'customer_phone' => 'Customer Phone',
            'customer_email' => 'Customer Email',
            'customer_address' => 'Customer Address',
            ] );
        $customer = Customers::first();
        $response = $this->patch('/customer/update/' .$customer->id ,[
            'customer_name' => 'New Customer Name',
            'customer_mobile' => 'New Customer Mobile',
        ]);
        $this->assertEquals('New Customer Name', Customers::first()->customer_name);

    }
}
