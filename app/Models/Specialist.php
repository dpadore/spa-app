<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class Specialist extends Model
{
    use HasFactory;

    protected $primaryKey = 'specialist_id';
    
    protected $fillable = [
        'name',
        'bio',
        'photo_path',
    ];
    
}
