<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

    class Specialist extends Model
{
    use HasFactory;

    protected $primaryKey = 'specialist_id';
    
    protected $fillable = [
        'name',
        'bio',
        'photo_path'
    ];

    public $timestamps = true;

    public function getPhotoUrlAttribute()
    {
        if ($this->photo_path) {
            return asset('img/' . $this->photo_path);
        }
        return null;
    }
     public function reservations()
    {
        return $this->hasMany(Reservation::class, 'specialist_id', 'specialist_id');
    }
    
}
