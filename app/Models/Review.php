<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'review_id';
    
    protected $fillable = [
        'user_id',
        'service_id',
        'rating',
        'comment',
        'review_date',
    ];
    
    public function getFormattedDate()
    {
        return $this->review_date->format('d.m.Y');
    }
    
}