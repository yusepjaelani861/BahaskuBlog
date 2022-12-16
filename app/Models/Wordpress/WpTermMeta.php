<?php

namespace App\Models\Wordpress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpTermMeta extends Model
{
    use HasFactory;

    protected $table = 'wp_termmeta';

    protected $fillable = [
        'meta_id',
        'term_id',
        'meta_key',
        'meta_value',
    ];
}
