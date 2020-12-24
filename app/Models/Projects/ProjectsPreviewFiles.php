<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsPreviewFiles extends Model
{
    use HasFactory;
    protected $table = 'projects_preview_files';
    protected $fillable = [
        'project_id',
        'file_name',
        'file_ext',
        'file_path',
    ];
}
