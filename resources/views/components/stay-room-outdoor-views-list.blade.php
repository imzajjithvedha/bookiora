@foreach(config('stayroomoutdoorviews.list') as $key => $outdoor_view)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="outdoor_views[]" value="{{ $outdoor_view }}" id="outdoor_view-{{ $key }}" {{ is_array(old('outdoor_views', $data ?? [])) && in_array($outdoor_view, old('outdoor_views', $data ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="outdoor_view-{{ $key }}">
            {{ $outdoor_view }}
        </label>
    </div>
@endforeach
