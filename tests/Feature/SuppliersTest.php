<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Suppliers;
use App\Models\User;

class SuppliersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */

    /** @test */
    public function only_logged_in_users_can_view_suppliers_list(){
        //$this->withoutExceptionHandling();
        $response = $this->get('/suppliers')->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_users_can_view_suppliers_list(){
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $response = $this->get('/suppliers');
        $response->assertOk();
    }

    /** @test */
    public function authenticated_users_can_view_supplier_profile(){
        $this->withoutExceptionHandling();
        $this->actingAsUser();
        $this->post('/supplier/adding', $this->data()  );
        $supplier = Suppliers::first();
        $response = $this->get('/supplier/view/'. $supplier->id);
        $response->assertOk();
    }

    /** @test */
    public function a_supplier_can_be_added_to_the_app()
    {
        $this->actingAsUser();
        $this->withoutExceptionHandling();
        $response = $this->post('/supplier/adding', $this->data() );
        $this->assertCount(1,Suppliers::all());
        $response->assertStatus(302);
    }

    /** @test */
    public function supplier_can_be_updated(){
        $this->actingAsUser();
        $this->withoutExceptionHandling();
        $this->post('/supplier/adding', $this->data()  );
        $supplier = Suppliers::first();
        $response = $this->patch('/supplier/update/' .$supplier->id ,[
            'supplier_name' => 'New Supplier Name',
            'supplier_mobile' => 'New Supplier Mobile',
        ]);
        $this->assertEquals('New Supplier Name', Suppliers::first()->supplier_name);
    }

    /** @test */
    public function supplier_can_be_deleted()
    {
        $this->actingAsUser();
        $this->withExceptionHandling();
        $this->post('/supplier/adding', $this->data()  );
        $supplier = Suppliers::first();
        $response = $this->delete('/supplier/delete/'. $supplier->id);
        $this->assertEquals(0,Suppliers::count());
    }








    private function actingAsUser(){
        $this->actingAs(User::factory()->create());
    }
    private function data(){
        return [
            'supplier_name' => 'Supplier Name',
            'supplier_mobile' => 'Supplier Mobile',
            'supplier_phone' => 'Supplier Phone',
            'supplier_company' => 'Supplier Compant',
            'supplier_email' => 'email@domain.com',
            'supplier_address' => 'Supplier Address',
            'supplier_notes' => 'Supplier Notes',
            'supplier_commercial_registry' => 'Supplier Commercial Registry',
            'supplier_tax_card' => 'Supplier Tax Card',
        ];
    }
}
