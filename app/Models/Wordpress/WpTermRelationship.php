<?php

namespace App\Models\Wordpress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WpTermRelationship extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'object_id',
        'term_taxonomy_id',
        'term_order',
    ];
}
