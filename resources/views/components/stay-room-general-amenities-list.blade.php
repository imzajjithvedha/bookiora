@foreach(config('stayroomgeneralamenities.list') as $key => $general_amenity)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="general_amenities[]" value="{{ $general_amenity }}" id="general_amenity-{{ $key }}" {{ is_array(old('general_amenities', $data ?? [])) && in_array($general_amenity, old('general_amenities', $data ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="general_amenity-{{ $key }}">
            {{ $general_amenity }}
        </label>
    </div>
@endforeach
