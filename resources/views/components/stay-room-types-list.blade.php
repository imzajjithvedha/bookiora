<option value="">Select type</option>

@foreach(config('stayroomtypes.list') as $stay_room_type)
    <option value="{{ $stay_room_type }}" {{ $data == $stay_room_type ? 'selected' : '' }}>{{ $stay_room_type }}</option>
@endforeach