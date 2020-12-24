<?php

namespace App\Models\Projects;

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

    ];

    public function customer()
    {
        return $this->hasOne('App\Models\Customers\Customers', 'id', 'customer_id');
    }


}
