<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Customers;
use App\Models\User;

class CustomerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function only_logged_in_users_can_view_customers_list(){
        //$this->withoutExceptionHandling();
        $response = $this->get('/customers')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_view_customers_list(){
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $response = $this->get('/customers');
        $response->assertOk();
    }

    /** @test */
    public function authenticated_users_can_view_customer_profile(){
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $this->post('/customer/adding', $this->data()  );
        $customer = Customers::first();
        $response = $this->get('/customer/view/'. $customer->id);
        $response->assertOk();
    }

    /** @test */
    public function a_customer_can_be_added_to_the_app()
    {
        $this->actingAsUser();
        $this->withoutExceptionHandling();
        $response = $this->post('/customer/adding', $this->data() );
        $this->assertCount(1,Customers::all());
        $response->assertStatus(302);
    }

    /** @test */
    public function customer_can_be_updated(){
        $this->actingAsUser();
        $this->withoutExceptionHandling();
        $this->post('/customer/adding', $this->data()  );
        $customer = Customers::first();
        $response = $this->patch('/customer/update/' .$customer->id ,[
            'customer_name' => 'New Customer Name',
            'customer_mobile' => 'New Customer Mobile',
        ]);
        $this->assertEquals('New Customer Name', Customers::first()->customer_name);
    }

    /** @test */
    public function customer_can_be_deleted()
    {
        $this->actingAsUser();
        $this->withExceptionHandling();
        $this->post('/customer/adding', $this->data()  );
        $customer = Customers::first();
        $response = $this->delete('/customer/delete/'. $customer->id);
        $this->assertEquals(0,Customers::count());
    }








    private function actingAsUser(){
        $this->actingAs(User::factory()->create());
    }
    private function data(){
        return [
            'customer_name' => 'Customer Name',
            'customer_title' => 'Customer Title',
            'customer_company' => 'Customer Company',
            'customer_mobile' => 'Customer Mobile',
            'customer_phone' => 'Customer Phone',
            'customer_email' => 'email@domain.com',
            'customer_address' => 'Customer Address',
            'customer_type' => 'Customer type',
            'customer_commercial_registry' => 'Customer Commercial Registry',
            'customer_tax_card' => 'Customer Tax Card',
        ];
    }
}
