@props(['data'])

<div class="col-12 mb-4 mb-md-5">
    <label for="status" class="form-label label">Status<span class="asterisk">*</span></label>

    <div class="radios">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="2" id="active" {{ old('status', $data->status) == 2 ? 'checked' : '' }} required>
            <label class="form-check-label" for="active">Active</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="1" id="pending" {{ old('status', $data->status) == 1 ? 'checked' : '' }} required>
            <label class="form-check-label" for="pending">Pending</label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="0" id="inactive" {{ old('status', $data->status) == 0 ? 'checked' : '' }} required>
            <label class="form-check-label" for="inactive">Inactive</label>
        </div>
    </div>

    <x-input-error field="status"></x-input-error>
</div>

<div class="col-12">
    <button type="submit" class="submit-button">Save Changes</button>
</div>