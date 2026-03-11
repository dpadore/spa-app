<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'reservation_id';
    
    protected $fillable = [
        'user_id',
        'service_id',
        'specialist_id',
        'reservation_date',
        'reservation_time',
        'status',
    ];
    
  
    public function isActive()
    {
        return $this->status === 'active';
    }
    
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
    
    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }
    
    public function getDateTime()
    {
        return $this->reservation_date->format('d.m.Y') . ' в ' . 
               $this->reservation_time->format('H:i');
    }
    
    public function getStatusBadge()
    {
        return match($this->status) {
            'active' => 'Активна',
            'completed' => 'Выполнена',
            'cancelled' => 'Отменена',
            default => $this->status,
        };
    }
}