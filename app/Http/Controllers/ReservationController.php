<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\Specialist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    // показать форму записи
    public function create(Request $request)
    {
        $services = Service::all();
        $specialists = Specialist::all();
        $selectedServiceId = $request->input('service_id');

        return view('reservations.create', compact('services', 'specialists', 'selectedServiceId'));
    }

    // сохранение
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,service_id',
            'specialist_id' => 'required|exists:specialists,specialist_id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required',
        ]);

        // Нельзя записаться на прошедшую дату
        $today = date('Y-m-d');
        $currentTime = date('H:i:s');
        
        // если дата сегодняшняя
        if ($request->reservation_date == $today) {
            if ($request->reservation_time < $currentTime) {
                return back()->withErrors(['time' => 'Это время уже не актуально'])->withInput();
            }
        }
        
        // если дата уже прошла
        if ($request->reservation_date < $today) {
            return back()->withErrors(['time' => 'Нельзя записаться на прошедшую дату'])->withInput();
        }

        // проверка на занятость времени у специалиста
        $exists = Reservation::where('specialist_id', $request->specialist_id)
            ->where('reservation_date', $request->reservation_date)
            ->where('reservation_time', $request->reservation_time)
            ->where('status', 'active')
            ->exists();

        if ($exists) {
            return back()->withErrors(['time' => 'Это время уже занято'])->withInput();
        }
    
        // проверка на занятость пользователя в это время
        $userBusy = Reservation::where('user_id', Auth::user()->user_id)
            ->where('reservation_date', $request->reservation_date)
            ->where('reservation_time', $request->reservation_time)
            ->where('status', 'active')
            ->exists();

        if ($userBusy) {
            return back()->withErrors(['time' => 'У вас уже есть активная запись на это время'])->withInput();
        }

        Reservation::create([
            'user_id' => Auth::user()->user_id,
            'service_id' => $request->service_id,
            'specialist_id' => $request->specialist_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'status' => 'active',
        ]);

        return redirect()->route('dashboard')->with('success', 'Запись успешно создана!');
    }

    public function cancelReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $this->authorize('cancel', $reservation);

        $reservation->update(['status' => 'cancelled']);
        return back()->with('success', 'Запись отменена');
    }
}