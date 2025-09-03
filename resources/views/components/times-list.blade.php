<option value="">Select Time</option>

@foreach(config('times.list') as $time)
    <option value="{{ $time }}" {{ $data == $time ? 'selected' : '' }}>
        {{ $time }}
    </option>
@endforeach
