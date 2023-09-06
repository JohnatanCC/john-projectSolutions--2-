<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'client_name',
        'title',
        'description',
        'observation',
        'project_link',
        'pdf_file',
        'photo_file'
    ];
}
