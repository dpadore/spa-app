<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Specialist;
use App\Models\Review;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $popularServices = Service::withCount('reservations')
                                 ->orderBy('reservations_count', 'desc')
                                 ->limit(6)
                                 ->get();
        
        $specialists = Specialist::limit(4)->get();
        $latestReviews = Review::with(['user', 'service'])
                              ->orderBy('review_date', 'desc')
                              ->limit(3)
                              ->get();
        
        return view('home', compact('popularServices', 'specialists', 'latestReviews'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        $activeReservations = Reservation::where('user_id', $user->id)
                                         ->where('status', 'active')
                                         ->where('reservation_date', '>=', now())
                                         ->with(['service', 'specialist'])
                                         ->get();
        
        return view('dashboard.index', compact('user', 'activeReservations'));
    }
}