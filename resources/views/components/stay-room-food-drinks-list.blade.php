@foreach(config('stayroomfooddrinks.list') as $key => $food_drink)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="food_drinks[]" value="{{ $food_drink }}" id="food_drink-{{ $key }}" {{ is_array(old('food_drinks', $data ?? [])) && in_array($food_drink, old('food_drinks', $data ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="food_drink-{{ $key }}">
            {{ $food_drink }}
        </label>
    </div>
@endforeach
