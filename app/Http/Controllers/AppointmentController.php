<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AvailableSlot;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        $availableSlots = AvailableSlot::all();
        return view('appointments.create', compact('availableSlots'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'slot_id' => 'required|exists:available_slots,id',
            'notes' => 'nullable|string',
        ]);
    
        $slot = AvailableSlot::findOrFail($request->slot_id);
    
        Appointment::create([
            'appointment_date' => $slot->date,
            'appointment_time' => $slot->time,
            'notes' => $request->notes,
            'status' => 'confirmed',
        ]);
    
        // احذف الموعد من جدول المواعيد المتاحة
        $slot->delete();
    
        return redirect()->back()->with('success', 'تم حجز الموعد بنجاح!');
    }
}
