@foreach(config('stayroombathroomitems.list') as $key => $bathroom_item)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="bathroom_items[]" value="{{ $bathroom_item }}" id="bathroom_item-{{ $key }}" {{ is_array(old('bathroom_items', $data ?? [])) && in_array($bathroom_item, old('bathroom_items', $data ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="bathroom_item-{{ $key }}">
            {{ $bathroom_item }}
        </label>
    </div>
@endforeach
