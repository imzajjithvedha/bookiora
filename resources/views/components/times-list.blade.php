<option value="">Select time</option>

@foreach(config('times.list') as $time)
    <option value="{{ $time }}" {{ $data == $time ? 'selected' : '' }}>
        {{ $time }}
    </option>
@endforeach
