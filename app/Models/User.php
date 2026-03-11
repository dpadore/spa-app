<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    
    protected $fillable = ['name','email','password','role',];

    protected $hidden = ['password','remember_token',];

    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isClient()
    {
        return $this->role === 'client';
    }
    
    public function getActiveReservations()
    {
        return $this->reservations()->where('status', 'active')->get();
    }
    
    public function getReservationsHistory()
    {
        return $this->reservations()->whereIn('status', ['completed', 'cancelled'])->get();
    }
    
    public function getFavoriteServices()
    {
        return $this->belongsToMany(Service::class, 'favorites', 'user_id', 'service_id');
    }
}

