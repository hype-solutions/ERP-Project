<?php

namespace App\Models\Projects;

use App\Models\Safes\Safes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'project_status',
        'customer_id',
        'project_name',
        'project_start_date',
        'project_end_date',
        'discount_amount',
        'discount_percentage',
        'tax',
        'shipping_fees',
        'total',
        'step',
        'created_by',
        'authorized_by',

    ];

    public function customer()
    {
        return $this->hasOne('App\Models\Customers\Customers', 'id', 'customer_id');
    }

    public function allSafes(){
        return Safes::all();
    }


    public function datesInProject()
    {
        return $this->hasMany('App\Models\Projects\ProjectsPayments', 'project_id', 'id');
    }

}
