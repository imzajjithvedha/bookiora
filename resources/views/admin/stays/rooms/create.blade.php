@extends('layouts.backend')

@section('title', 'Create Room')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.stays.rooms.store', $stay) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="page-details mb-3 mb-md-4">
                <p class="title raleway">{{ $stay->name }}: Add New Room</p>
                <p class="description">Fill in the details below to create a new room.</p>
            </div>
            
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="custom_name" class="form-label label">Custom name</label>
                    <input type="text" class="form-control input-field" id="custom_name" name="custom_name" placeholder="Custom name" value="{{ old('custom_name') }}">
                    <x-input-error field="custom_name"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="name" class="form-label label">
                        Name
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="This is the name that guests will see on your property page. Choose a name that most accurately describes this room."><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <select class="form-select js-single input-field" id="name" name="name" required>
                        <x-stay-room-names-list :data="old('name', 'Double Room')"></x-stay-room-names-list>
                    </select>

                    <x-input-error field="name"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="type" class="form-label label">What type of unit is this?<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="type" name="type" required>
                        <x-stay-room-types-list :data="old('type', 'Double')"></x-stay-room-types-list>
                    </select>

                    <x-input-error field="type"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="number_of_rooms" class="form-label label">
                        No of rooms
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="How many rooms of this type do you have?"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <input type="number" class="form-control input-field" id="number_of_rooms" name="number_of_rooms" placeholder="Number of rooms" value="{{ old('number_of_rooms', 1) }}" min="1" required>
                    <x-input-error field="number_of_rooms"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="single_bed_count" class="form-label label">Single bed count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="single_bed_count" name="single_bed_count" placeholder="Single bed count" value="{{ old('single_bed_count', 0) }}" min="0" required>
                    <x-input-error field="single_bed_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="double_bed_count" class="form-label label">Double bed count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="double_bed_count" name="double_bed_count" placeholder="Double bed count" value="{{ old('double_bed_count', 1) }}" min="0" required>
                    <x-input-error field="double_bed_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="large_bed_count" class="form-label label">Large bed count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="large_bed_count" name="large_bed_count" placeholder="Large bed count" value="{{ old('large_bed_count', 0) }}" min="0" required>
                    <x-input-error field="large_bed_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="extra_large_double_bed_count" class="form-label label">XL double bed count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="extra_large_double_bed_count" name="extra_large_double_bed_count" placeholder="XL double bed count" value="{{ old('extra_large_double_bed_count', 0) }}" min="0" required>
                    <x-input-error field="extra_large_double_bed_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="bunk_bed_count" class="form-label label">Bunk bed count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="bunk_bed_count" name="bunk_bed_count" placeholder="Bunk bed count" value="{{ old('bunk_bed_count', 0) }}" min="0" required>
                    <x-input-error field="bunk_bed_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="sofa_bed_count" class="form-label label">Sofa bed count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="sofa_bed_count" name="sofa_bed_count" placeholder="Sofa bed count" value="{{ old('sofa_bed_count', 0) }}" min="0" required>
                    <x-input-error field="sofa_bed_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="futon_mat_count" class="form-label label">Futon mat count<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="futon_mat_count" name="futon_mat_count" placeholder="Futon mat count" value="{{ old('futon_mat_count', 0) }}" min="0" required>
                    <x-input-error field="futon_mat_count"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-4">
                    <label for="number_of_guests" class="form-label label">
                        No of guests
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="How many guests can stay in this room?"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <input type="number" class="form-control input-field" id="number_of_guests" name="number_of_guests" placeholder="Futon Mat" value="{{ old('number_of_guests', 2) }}" min="1" required>
                    <x-input-error field="number_of_guests"></x-input-error>
                </div>

                <div class="col-12 col-md-4 col-lg-6 mb-3 mb-md-4">
                    <label for="smoking_allowed" class="form-label label">Is smoking allowed?<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="smoking_allowed" name="smoking_allowed" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('smoking_allowed') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('smoking_allowed', 'no') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="smoking_allowed"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="bathroom_private" class="form-label label">Is the bathroom private?<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="bathroom_private" name="bathroom_private" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('bathroom_private', 'yes') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('bathroom_private') == 'no' ? "selected" : "" }}>No, it's shared</option>
                    </select>
                    <x-input-error field="bathroom_private"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="bathroom_items" class="form-label label">Which bathroom items are available in this room?</label>
                    <div class="checks">
                        <x-stay-room-bathroom-items-list :data="old('bathroom_items')"></x-stay-room-bathroom-items-list>
                    </div>
                    <x-input-error field="bathroom_items.*"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="general_amenities" class="form-label label">Which general amenities are available in this room?</label>
                    <div class="checks">
                        <x-stay-room-general-amenities-list :data="old('general_amenities')"></x-stay-room-general-amenities-list>
                    </div>
                    <x-input-error field="general_amenities.*"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="outdoor_views" class="form-label label">Which outdoors and views are available in this room?</label>
                    <div class="checks">
                        <x-stay-room-outdoor-views-list :data="old('outdoor_views')"></x-stay-room-outdoor-views-list>
                    </div>
                    <x-input-error field="outdoor_views.*"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="food_drinks" class="form-label label">Which food and drinks are available in this room?</label>
                    <div class="checks">
                        <x-stay-room-food-drinks-list :data="old('food_drinks')"></x-stay-room-food-drinks-list>
                    </div>
                    <x-input-error field="food_drinks.*"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="charge_per_night" class="form-label label">
                        Charge per night
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="How much do you want to charge per night? (Including taxes, commission and charges)"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <input type="number" class="form-control input-field" id="charge_per_night" name="charge_per_night" placeholder="Charge per night" value="{{ old('charge_per_night') }}" min="0" step="0.01" required>
                    <x-input-error field="charge_per_night"></x-input-error>

                    <div class="info-box d-none">
                        <p class="info-box-title raleway"><span class="special">10.00%</span>- Bookiora.com commission</p>

                        <ul class="info-box-features">
                            <li><i class="bi bi-cursor-fill"></i>24/7 support for you and your guests</li>
                            <li><i class="bi bi-cursor-fill"></i>Save time with instant booking confirmations</li>
                            <li><i class="bi bi-cursor-fill"></i>Increased visibility - we promote your property on Google and other channels</li>
                            <li><i class="bi bi-cursor-fill"></i>We collect our 10% commission directly from the booking payment - no extra billing for you</li>
                            <li><i class="bi bi-cursor-fill"></i>No upfront costs - list your property for free</li>
                        </ul>

                        <p class="info-box-title raleway">US$<span class="special" id="amount">30</span>- Your earnings (including taxes)</p>
                    </div>
                </div>

                <!-- <div class="col-12 mb-3 mb-md-4">
                    <label for="price_per_group" class="form-label label">Price Per Group?<span class="asterisk">*</span></label>
                    <select class="form-select input-field mb-3" id="price_per_group" name="price_per_group" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('price_per_group') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('price_per_group', 'no') == 'no' ? "selected" : "" }}>No</option>
                    </select>

                    <div class="group">
                        <div class="row mb-3">
                            <div class="col-5">
                                <p>Occupancy</p>
                            </div>

                            <div class="col-2">
                                <p>Discount (%)</p>
                            </div>

                            <div class="col-5">
                                <p>Guests Pay</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5">
                                <i class="bi bi-person-standing"></i> X 2
                            </div>
                            <div class="col-2">
                                <p>0</p>
                            </div>
                            <div class="col-5">
                                <p>US$ 30.00</p>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-5">
                                <i class="bi bi-person-standing"></i> X 1
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control input-field" id="discount" name="discount" placeholder="Discount" value="10" min="0" required>
                            </div>
                            <div class="col-5">
                                <p>US$ 30.00</p>
                            </div>
                        </div>
                    </div>
                    <x-input-error field="price_per_group"></x-input-error>
                </div> -->

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="free_cancellation_window" class="form-label label">
                        Free cancellation time
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title=" When can the guests cancel their bookings for free?"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <select class="form-select input-field" id="free_cancellation_window" name="free_cancellation_window" required>
                        <option value="">Select</option>
                        <option value="Before 18:00 on the day of arrival" {{ old('free_cancellation_window', 'Before 18:00 on the day of arrival') == 'Before 18:00 on the day of arrival' ? "selected" : "" }}>Before 18:00 on the day of arrival</option>
                        <option value="Up to 1 day before the day of arrival" {{ old('free_cancellation_window') == 'Up to 1 day before the day of arrival' ? "selected" : "" }}>Up to 1 day before the day of arrival</option>
                        <option value="Up to 2 days before the day of arrival" {{ old('free_cancellation_window') == 'Up to 2 days before the day of arrival' ? "selected" : "" }}>Up to 2 days before the day of arrival</option>
                        <option value="Up to 3 days before the day of arrival" {{ old('free_cancellation_window') == 'Up to 3 days before the day of arrival' ? "selected" : "" }}>Up to 3 days before the day of arrival</option>
                        <option value="Up to 4 days before the day of arrival" {{ old('free_cancellation_window') == 'Up to 4 days before the day of arrival' ? "selected" : "" }}>Up to 4 days before the day of arrival</option>
                        <option value="Up to 7 days before the day of arrival" {{ old('free_cancellation_window') == 'Up to 7 days before the day of arrival' ? "selected" : "" }}>Up to 7 days before the day of arrival</option>

                        <option value="Up to 14 days before the day of arrival" {{ old('free_cancellation_window') == 'Up to 14 days before the day of arrival' ? "selected" : "" }}>Up to 14 days before the day of arrival</option>
                    </select>

                    <x-input-error field="free_cancellation_window"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="windows_cancellation_payment" class="form-label label">
                        Cancellation charge
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="How much are your guests charged if they cancel after the cancellation window?"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>

                    <select class="form-select input-field" id="windows_cancellation_payment" name="windows_cancellation_payment" required>
                        <option value="">Select</option>
                        <option value="Cost of the first night" {{ old('windows_cancellation_payment', 'Cost of the first night') == 'Cost of the first night' ? "selected" : "" }}>Cost of the first night</option>
                        <option value="100% of the total price" {{ old('windows_cancellation_payment') == '100% of the total price' ? "selected" : "" }}>100% of the total price</option>
                    </select>

                    <x-input-error field="windows_cancellation_payment"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="non_refundable_rate_plan" class="form-label label">Non refundable rate plan<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="non_refundable_rate_plan" name="non_refundable_rate_plan" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('non_refundable_rate_plan', 'yes') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('non_refundable_rate_plan') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="non_refundable_rate_plan"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="non_refundable_rate_discount" class="form-label label">
                        Non refundable rate plan discount (%)
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Discount for guests that book with this non refundable rate plan"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <input type="number" class="form-control input-field" id="non_refundable_rate_discount" name="non_refundable_rate_discount" placeholder="Futon Mat" value="{{ old('non_refundable_rate_discount', 10) }}" min="0" required>
                    <x-input-error field="non_refundable_rate_discount"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="weekly_rate_plan" class="form-label label">Weekly rate plan<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="weekly_rate_plan" name="weekly_rate_plan" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('weekly_rate_plan', 'yes') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('weekly_rate_plan') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="weekly_rate_plan"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="weekly_rate_discount" class="form-label label">
                        Weekly rate plan discount (%)
                        <span class="info-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Discount for guests that book with this weekly rate plan"><i class="bi bi-info-circle-fill"></i></span>
                        <span class="asterisk">*</span>
                    </label>
                    <input type="number" class="form-control input-field" id="weekly_rate_discount" name="weekly_rate_discount" placeholder="Discount" value="{{ old('weekly_rate_discount', 15) }}" min="0" required>
                    <x-input-error field="weekly_rate_discount"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <x-upload-image-must old_name="old_thumbnail" old_value="{{ old('thumbnail') }}" new_name="new_thumbnail" path="stays" label="thumbnail"></x-upload-image-must>
                    <x-input-error field="new_thumbnail"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <x-upload-multi-images image_count="5" old_name="old_images" old_value="{{ old('images') }}" new_name="new_images[]" path="stays" label="images"></x-upload-multi-images>
                    <x-input-error field="new_images.*"></x-input-error>
                </div>

                <x-create-status></x-create>
            </div>
        </form>
    </div>
@endsection

@push('after-scripts')
    <script>
        $(document).ready(function() {
            function calculateGuestCount() {
                let total = 0;

                $('#single_bed_count, #double_bed_count, #large_bed_count, #extra_large_double_bed_count, #bunk_bed_count, #sofa_bed_count, #futon_mat_count').each(function() {
                    let bed = $(this).attr('name');
                    let value = $(this).val();

                    if(['single_bed_count', 'bunk_bed_count', 'sofa_bed_count', 'futon_mat_count'].includes(bed)) {
                        total += value * 1;
                    }
                    else {
                        total += value * 2;
                    }
                });

                $('#number_of_guests').val(total);
            }

            function calculateEarnings() {
                let value = $('#charge_per_night').val();

                if(value != 0 || value != '' || value == null) {
                    let earning = value - (value * 0.1);

                    $('.info-box').removeClass('d-none');
                    $('#amount').text(earning.toFixed(2));
                }
                else {
                    $('.info-box').addClass('d-none');
                    $('#amount').text('');
                }
            }

            $('#single_bed_count, #double_bed_count, #large_bed_count, #extra_large_double_bed_count, #bunk_bed_count, #sofa_bed_count, #futon_mat_count').on('change', calculateGuestCount);
            $('#charge_per_night').on('input', calculateEarnings);

            calculateGuestCount();
            calculateEarnings();
        });
    </script>
@endpush