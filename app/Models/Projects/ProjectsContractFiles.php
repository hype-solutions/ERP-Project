<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsContractFiles extends Model
{
    use HasFactory;
    protected $table = 'projects_contract_files';
    protected $fillable = [
        'project_id',
        'file_name',
        'file_ext',
        'file_path',
    ];
}
