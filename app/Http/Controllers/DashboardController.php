<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Активные записи
        $activeReservations = Reservation::where('user_id', $user->user_id)
            ->where('status', 'active')
            ->where('reservation_date', '>=', now()->format('Y-m-d'))
            ->with(['service', 'specialist'])
            ->orderBy('reservation_date')
            ->orderBy('reservation_time')
            ->get();

        // Завершённые записи
        $completedReservations = Reservation::where('user_id', $user->user_id)
            ->where(function ($query) {
                $query->where('status', 'completed')
                    ->orWhere(function ($q) {
                        $q->where('status', 'active')
                            ->where('reservation_date', '<', now()->format('Y-m-d'));
                    });
            })
            ->with(['service', 'specialist'])
            ->orderBy('reservation_date', 'desc')
            ->orderBy('reservation_time', 'desc')
            ->get();

        // Отменённые записи
        $cancelledReservations = Reservation::where('user_id', $user->user_id)
            ->where('status', 'cancelled')
            ->with(['service', 'specialist'])
            ->orderBy('reservation_date', 'desc')
            ->orderBy('reservation_time', 'desc')
            ->get();

        $favorites = Favorite::where('user_id', $user->user_id)
            ->with('service')
            ->get();

        return view('dashboard.index', compact(
            'user',
            'activeReservations',
            'completedReservations',
            'cancelledReservations',
            'favorites',
        ));
    }

    // Автоматически завершаем прошедшие активные записи
    public function updateReservationsStatus()
    {
        $updated = Reservation::where('status', 'active')
            ->where('reservation_date', '<', now()->format('Y-m-d'))
            ->update(['status' => 'completed']);

        return redirect()->route('dashboard')->with('info', "Обновлено {$updated} записей");
    }

    // форма редактирования профиля
    public function editProfile()
    {
        $user = Auth::user();
        return view('dashboard.edit', ['user' => $user]);
    }

    // изменение профиля
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('dashboard')->with('success', 'Профиль обновлен');
    }

    // избранное
    public function favorites()
    {
        $favorites = Favorite::where('user_id', Auth::user()->user_id)
            ->with('service')
            ->get();

        return view('dashboard.favorites', compact('favorites'));
    }

    public function addFavorite($serviceId)
    {
        $exists = Favorite::where('user_id', Auth::id())
            ->where('service_id', $serviceId)
            ->exists();

        if (!$exists) {
            Favorite::create([
                'user_id' => Auth::id(),
                'service_id' => $serviceId,
            ]);
            return back()->with('success', 'Услуга добавлена в избранное');
        }

        return back()->with('info', 'Услуга уже в избранном');
    }

    public function removeFavorite($serviceId)
    {
        Favorite::where('user_id', Auth::id())
            ->where('service_id', $serviceId)
            ->delete();

        return back()->with('success', 'Услуга удалена из избранного');
    }
}