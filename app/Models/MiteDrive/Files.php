<?php

namespace App\Models\MiteDrive;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    use HasFactory;

    protected $connection = 'mitedrive';

    protected $fillable = [
        'user_id',
        'short_url',
        'filename',
        'title',
        'size',
        'extension',
        'mime_type',
        'original_url',
        'download_count',
        'monetize',
        'status'
    ];
    
    protected $hidden = [
        'user_id',
        'filename'
    ];
}
