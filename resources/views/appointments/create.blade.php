@extends('layouts.app')

@section('content')
<div class="container">
    <h2>احجز موعد</h2>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('appointments.store') }}">
        @csrf

        <label>اختر موعدًا متاحًا:</label><br>
        <select name="slot_id" required>
            @foreach($availableSlots as $slot)
                <option value="{{ $slot->id }}">
                    {{ $slot->date }} - {{ \Carbon\Carbon::parse($slot->time)->format('h:i A') }}
                </option>
            @endforeach
        </select><br><br>

        <label>ملاحظات:</label><br>
        <textarea name="notes" rows="3"></textarea><br><br>

        <button type="submit">احجز الموعد</button>
    </form>
</div>
@endsection
