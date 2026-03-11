<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    
    protected $fillable = [
        'name',
        'description',
    ];
    
    public function getServicesCount()
    {
        return $this->services()->count();
    }
    
    public function getMinPrice()
    {
        return $this->services()->min('price');
    }
    
    public function getMaxPrice()
    {
        return $this->services()->max('price');
    }
    
    public function getAveragePrice()
    {
        return round($this->services()->avg('price'), 2);
    }
    
    public function getPopularServices($limit = 3)
    {
        return $this->services()
                    ->withCount('reservations')
                    ->orderBy('reservations_count', 'desc')
                    ->limit($limit)
                    ->get();
    }
}