<?php

namespace App\Models\Wordpress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpPostMeta extends Model
{
    use HasFactory;

    protected $table = 'wp_postmeta';

    protected $fillable = [
        'meta_id',
        'post_id',
        'meta_key',
        'meta_value',
    ];
}
