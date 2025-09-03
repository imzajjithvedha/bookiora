@foreach(config('facilities.list') as $key => $facility)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="facilities[]" value="{{ $facility }}" id="facility-{{ $key }}" {{ is_array(old('facilities', $data ?? [])) && in_array($facility, old('facilities', $data ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="facility-{{ $key }}">
            {{ $facility }}
        </label>
    </div>
@endforeach
