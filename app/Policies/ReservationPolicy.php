<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;

class ReservationPolicy
{
    public function cancel(User $user, Reservation $reservation)
    {
        return $user->user_id === $reservation->user_id && $reservation->status === 'active';
    }
}
