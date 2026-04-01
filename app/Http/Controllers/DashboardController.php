<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $activeReservations = Reservation::where('user_id', $user->user_id)
                                         ->where('status', 'active')
                                         ->where('reservation_date', '>=', now())
                                         ->with(['service', 'specialist'])
                                         ->orderBy('reservation_date')
                                         ->orderBy('reservation_time')
                                         ->get();
        
        $reservationsHistory = Reservation::where('user_id', $user->user_id)
                                          ->whereIn('status', ['completed', 'cancelled'])
                                          ->with(['service', 'specialist'])
                                          ->orderBy('reservation_date', 'desc')
                                          ->get();
        
        $favorites = Favorite::where('user_id', $user->user_id)
                             ->with('service')
                             ->get();
        
        $reviews = Review::where('user_id', $user->user_id)
                         ->with('service')
                         ->orderBy('review_date', 'desc')
                         ->get();
        
        return view('dashboard.index', compact('user', 'activeReservations', 
                                                'reservationsHistory', 'favorites', 'reviews'));
    }

}