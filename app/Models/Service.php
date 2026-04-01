<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $primaryKey = 'service_id';
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'duration',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'service_id', 'service_id');
    }
    
    public function reviews()
    {
        return $this->hasMany(Review::class, 'service_id', 'service_id');
    }
    
    public function favoritedBy()
    {
        return $this->hasMany(Favorite::class, 'service_id', 'service_id');
    }
    
    public function formattedDuration()
    {
        if ($this->duration >= 60) {
            $hours = floor($this->duration / 60);
            $minutes = $this->duration % 60;
            return $hours . ' ч ' . ($minutes > 0 ? $minutes . ' мин' : '');
        }
        return $this->duration . ' мин';
    }
    
    public function averageRating()
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }
    
    public function reviewsCount()
    {
        return $this->reviews()->count();
    }
    
    public function favoritesCount()
    {
        return $this->favoritedBy()->count();
    }
    
    public function reservationsCount()
    {
        return $this->reservations()->count();
    }
    
    public function isInFavorites($userId)
    {
        return $this->favoritedBy()->where('user_id', $userId)->exists();
    }
    
}