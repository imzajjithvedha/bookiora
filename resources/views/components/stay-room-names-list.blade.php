<option value="">Select name</option>

@foreach(config('stayroomnames.list') as $stay_room_name)
    <option value="{{ $stay_room_name }}" {{ $data == $stay_room_name ? 'selected' : '' }}>{{ $stay_room_name }}</option>
@endforeach