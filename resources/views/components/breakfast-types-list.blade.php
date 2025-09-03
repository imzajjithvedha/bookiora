@foreach(config('breakfasttypes.list') as $key => $breakfast_type)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="breakfast_types[]" value="{{ $breakfast_type }}" id="breakfast_type-{{ $key }}" {{ is_array(old('breakfast_types', $data ?? [])) && in_array($breakfast_type, old('breakfast_types', $data ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="breakfast_type-{{ $key }}">
            {{ $breakfast_type }}
        </label>
    </div>
@endforeach
