<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsAttachmentFiles extends Model
{
    use HasFactory;
    protected $table = 'projects_attachment_files';
    protected $fillable = [
        'project_id',
        'file_name',
        'file_ext',
        'file_path',
    ];
}
