<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $primaryKey = 'favorite_id';
    
    protected $fillable = [
        'user_id',
        'service_id',
    ];
    
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    
    public function scopeForService($query, $serviceId)
    {
        return $query->where('service_id', $serviceId);
    }
}