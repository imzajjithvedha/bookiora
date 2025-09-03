@extends('layouts.backend')

@section('title', 'Create Stay')

@section('content')
    <div class="inner-page">
        <form action="{{ route('admin.stays.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="page-details mb-3 mb-md-4">
                <p class="title raleway">Add New Stay</p>
                <p class="description">Fill in the details below to create a new stay.</p>
            </div>
            
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="name" class="form-label label">Name<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                    <x-input-error field="name"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="user_id" class="form-label label">User<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="user_id" name="user_id" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error field="user_id"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="address" class="form-label label">Address<span class="asterisk">*</span></label>

                    <div class="place-autocomplete-card" id="place-autocomplete-card"></div>
                    <div id="map"></div>

                    <input type="hidden" id="address" name="address" required>
                    <input type="hidden" id="latitude" name="latitude" required>
                    <input type="hidden" id="longitude" name="longitude" required>

                    <x-input-error field="address"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="apartment_floor_number" class="form-label label">Apartment or Floor Number</label>
                    <input type="text" class="form-control input-field" id="apartment_floor_number" name="apartment_floor_number" placeholder="Apartment or Floor Number" value="{{ old('apartment_floor_number') }}">
                    <x-input-error field="apartment_floor_number"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="city" class="form-label label">City<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="city" name="city" placeholder="City" value="{{ old('city') }}" required>
                    <x-input-error field="city"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="post_code" class="form-label label">Post Code<span class="asterisk">*</span></label>
                    <input type="text" class="form-control input-field" id="post_code" name="post_code" placeholder="Post Code" value="{{ old('post_code') }}" required>
                    <x-input-error field="post_code"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="country" class="form-label label">Country<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="country" name="country">
                        <option value="">Select Country</option>
                        <x-countries-list :data="old('country')"></x-countries-list>
                    </select>
                    <x-input-error field="country"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="star_rating" class="form-label label">Star Rating<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="star_rating" name="star_rating" required>
                        <option value="">Select Star Rating</option>
                        <option value="na" {{ old('star_rating') == 'na' ? "selected" : "" }}>Not Available</option>
                        <option value="1" {{ old('star_rating') == '1' ? "selected" : "" }}>1</option>
                        <option value="2" {{ old('star_rating') == '2' ? "selected" : "" }}>2</option>
                        <option value="3" {{ old('star_rating') == '3' ? "selected" : "" }}>3</option>
                        <option value="4" {{ old('star_rating') == '4' ? "selected" : "" }}>4</option>
                        <option value="5" {{ old('star_rating') == '5' ? "selected" : "" }}>5</option>
                    </select>
                    <x-input-error field="star_rating"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="breakfast" class="form-label label">Breakfast (Do you serve guests breakfast?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="breakfast" name="breakfast" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('breakfast') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('breakfast') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="breakfast"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4 d-none breakfast-types">
                    <label for="breakfast_types" class="form-label label">Breakfast Types</label>
                    <div class="checks">
                        <x-breakfast-types-list :data="old('breakfast_types')"></x-breakfast-types-list>
                    </div>
                    <x-input-error field="breakfast_types.*"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none breakfast-pay">
                    <label for="breakfast_pay" class="form-label label">Breakfast Pay (Is breakfast included in the price guests pay?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="breakfast_pay" name="breakfast_pay" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('breakfast_pay') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('breakfast_pay') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="breakfast_pay"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none breakfast-cost">
                    <label for="breakfast_cost" class="form-label label">Breakfast Cost (Price per person, per day)<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="breakfast_cost" name="breakfast_cost" placeholder="Breakfast Cost" value="{{ old('breakfast_cost') }}" required>
                    <x-input-error field="breakfast_cost"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="parking" class="form-label label">Parking (Is parking available to guests?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="parking" name="parking" required>
                        <option value="">Select</option>
                        <option value="yes_free" {{ old('parking') == 'yes_free' ? "selected" : "" }}>Yes, Free</option>
                        <option value="yes_paid" {{ old('parking') == 'yes_paid' ? "selected" : "" }}>Yes, Paid</option>
                        <option value="no" {{ old('parking') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="parking"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none parking-reserve">
                    <label for="parking_reserve" class="form-label label">Parking Reserve (Do they need to reserve a parking spot?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="parking_reserve" name="parking_reserve" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('parking_reserve') == 'yes' ? "selected" : "" }}>Reservation needed</option>
                        <option value="no" {{ old('parking_reserve') == 'no' ? "selected" : "" }}>No reservation needed</option>
                    </select>
                    <x-input-error field="parking_reserve"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none parking-location">
                    <label for="parking_location" class="form-label label">Parking Location (Where is the parking located?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="parking_location" name="parking_location" required>
                        <option value="">Select</option>
                        <option value="onsite" {{ old('parking_location') == 'onsite' ? "selected" : "" }}>On Site</option>
                        <option value="offsite" {{ old('parking_location') == 'offsite' ? "selected" : "" }}>Off Site</option>
                    </select>
                    <x-input-error field="parking_location"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none parking-type">
                    <label for="parking_type" class="form-label label">Parking Type (What type of parking is it?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="parking_type" name="parking_type" required>
                        <option value="">Select</option>
                        <option value="private" {{ old('parking_type') == 'private' ? "selected" : "" }}>Private</option>
                        <option value="public" {{ old('parking_type') == 'public' ? "selected" : "" }}>Public</option>
                    </select>
                    <x-input-error field="parking_type"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none parking-cost">
                    <label for="parking_cost" class="form-label label">Parking Cost (How much does parking cost?)<span class="asterisk">*</span></label>
                    <input type="number" class="form-control input-field" id="parking_cost" name="parking_cost" placeholder="Parking Cost" value="{{ old('parking_cost') }}" required>
                    <x-input-error field="parking_cost"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none parking-cost-type">
                    <label for="parking_cost_type" class="form-label label">Parking Cost Type<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="parking_cost_type" name="parking_cost_type" required>
                        <option value="">Select</option>
                        <option value="per_hour" {{ old('parking_cost_type') == 'per_hour' ? "selected" : "" }}>Per Hour</option>
                        <option value="per_day" {{ old('parking_cost_type') == 'per_day' ? "selected" : "" }}>Per Day</option>
                        <option value="per_stay" {{ old('parking_cost_type') == 'per_stay' ? "selected" : "" }}>Per Stay</option>
                    </select>
                    <x-input-error field="parking_cost_type"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <label for="facilities" class="form-label label">Facilities</label>
                    <div class="checks">
                        <x-facilities-list :data="old('facilities')"></x-facilities-list>
                    </div>
                    <x-input-error field="facilities.*"></x-input-error>
                </div>

                <!-- <div class="col-12 mb-3 mb-md-4">
                    <label for="staff-languages" class="form-label label">Staff Languages (What languages do you or your staff speak?)</label>
                    <div class="checks">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="English" id="staff-language-01">
                            <label class="form-check-label" for="staff-language-01">
                                English
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="French" id="staff-language-02">
                            <label class="form-check-label" for="staff-language-02">
                                French
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="German" id="staff-language-03">
                            <label class="form-check-label" for="staff-language-03">
                                German
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Tamil" id="staff-language-04">
                            <label class="form-check-label" for="staff-language-04">
                                Tamil
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Hindi" id="staff-language-05">
                            <label class="form-check-label" for="staff-language-05">
                                Hindi
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Sinhala" id="staff-language-06">
                            <label class="form-check-label" for="staff-language-06">
                                Sinhala
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Arabic" id="staff-language-07">
                            <label class="form-check-label" for="staff-language-07">
                                Arabic
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Bulgarian" id="staff-language-08">
                            <label class="form-check-label" for="staff-language-08">
                                Bulgarian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Catalan" id="staff-language-09">
                            <label class="form-check-label" for="staff-language-09">
                                Catalan
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Chinese" id="staff-language-10">
                            <label class="form-check-label" for="staff-language-10">
                                Chinese
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Croatian" id="staff-language-11">
                            <label class="form-check-label" for="staff-language-11">
                                Croatian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Czech" id="staff-language-12">
                            <label class="form-check-label" for="staff-language-12">
                                Czech
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Danish" id="staff-language-13">
                            <label class="form-check-label" for="staff-language-13">
                                Danish
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Dutch" id="staff-language-14">
                            <label class="form-check-label" for="staff-language-14">
                                Dutch
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Estonian" id="staff-language-15">
                            <label class="form-check-label" for="staff-language-15">
                                Estonian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Filipino" id="staff-language-16">
                            <label class="form-check-label" for="staff-language-16">
                                Filipino
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Finnish" id="staff-language-17">
                            <label class="form-check-label" for="staff-language-17">
                                Finnish
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Georgian" id="staff-language-18">
                            <label class="form-check-label" for="staff-language-18">
                                Georgian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Greek" id="staff-language-19">
                            <label class="form-check-label" for="staff-language-19">
                                Greek
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Hebrew" id="staff-language-20">
                            <label class="form-check-label" for="staff-language-20">
                                Hebrew
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Hungarian" id="staff-language-21">
                            <label class="form-check-label" for="staff-language-21">
                                Hungarian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Icelandic" id="staff-language-22">
                            <label class="form-check-label" for="staff-language-22">
                                Icelandic
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Indonesian" id="staff-language-23">
                            <label class="form-check-label" for="staff-language-23">
                                Indonesian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Italian" id="staff-language-24">
                            <label class="form-check-label" for="staff-language-24">
                                Italian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Japanese" id="staff-language-25">
                            <label class="form-check-label" for="staff-language-25">
                                Japanese
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Korean" id="staff-language-26">
                            <label class="form-check-label" for="staff-language-26">
                                Korean
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Latvian" id="staff-language-27">
                            <label class="form-check-label" for="staff-language-27">
                                Latvian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Lithuanian" id="staff-language-28">
                            <label class="form-check-label" for="staff-language-28">
                                Lithuanian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Malay" id="staff-language-29">
                            <label class="form-check-label" for="staff-language-29">
                                Malay
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Norwegian" id="staff-language-30">
                            <label class="form-check-label" for="staff-language-30">
                                Norwegian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Polish" id="staff-language-31">
                            <label class="form-check-label" for="staff-language-31">
                                Polish
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Portuguese" id="staff-language-32">
                            <label class="form-check-label" for="staff-language-32">
                                Portuguese
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Romanian" id="staff-language-33">
                            <label class="form-check-label" for="staff-language-33">
                                Romanian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Russian" id="staff-language-34">
                            <label class="form-check-label" for="staff-language-34">
                                Russian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Serbian" id="staff-language-35">
                            <label class="form-check-label" for="staff-language-35">
                                Serbian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Slovak" id="staff-language-36">
                            <label class="form-check-label" for="staff-language-36">
                                Slovak
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Slovenian" id="staff-language-37">
                            <label class="form-check-label" for="staff-language-37">
                                Slovenian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Spanish" id="staff-language-38">
                            <label class="form-check-label" for="staff-language-38">
                                Spanish
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Swedish" id="staff-language-39">
                            <label class="form-check-label" for="staff-language-39">
                                Swedish
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Thai" id="staff-language-40">
                            <label class="form-check-label" for="staff-language-40">
                                Thai
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Turkish" id="staff-language-41">
                            <label class="form-check-label" for="staff-language-41">
                                Turkish
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Ukrainian" id="staff-language-42">
                            <label class="form-check-label" for="staff-language-42">
                                Ukrainian
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="facilities[]" value="Vietnamese" id="staff-language-43">
                            <label class="form-check-label" for="staff-language-43">
                                Vietnamese
                            </label>
                        </div>
                    </div>
                </div> -->

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="check_in_time_from" class="form-label label">Check In From<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="check_in_time_from" name="check_in_time_from">
                        <x-times-list :data="old('check_in_time_from')"></x-times-list>
                    </select>
                    <x-input-error field="check_in_time_from"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="check_in_time_until" class="form-label label">Check In Until<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="check_in_time_until" name="check_in_time_until">
                        <x-times-list :data="old('check_in_time_until')"></x-times-list>
                    </select>
                    <x-input-error field="check_in_time_until"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="check_out_time_from" class="form-label label">Check Out From<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="check_out_time_from" name="check_out_time_from">
                        <x-times-list :data="old('check_out_time_from')"></x-times-list>
                    </select>
                    <x-input-error field="check_out_time_from"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="check_out_time_until" class="form-label label">Check Out Until<span class="asterisk">*</span></label>
                    <select class="form-select js-single input-field" id="check_out_time_until" name="check_out_time_until">
                        <x-times-list :data="old('check_out_time_until')"></x-times-list>
                    </select>
                    <x-input-error field="check_out_time_until"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="allow_children" class="form-label label">Children (Do you allow children?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="allow_children" name="allow_children" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('allow_children') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('allow_children') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="allow_children"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4">
                    <label for="allow_pets" class="form-label label">Pets (Do you allow pets?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="allow_pets" name="allow_pets" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('allow_pets') == 'yes' ? "selected" : "" }}>Yes</option>
                        <option value="no" {{ old('allow_pets') == 'no' ? "selected" : "" }}>No</option>
                    </select>
                    <x-input-error field="allow_pets"></x-input-error>
                </div>

                <div class="col-12 col-md-6 mb-3 mb-md-4 d-none allow-pets-charges">
                    <label for="allow_pets_charges" class="form-label label">Pets Charges (Are there additional charges for pets?)<span class="asterisk">*</span></label>
                    <select class="form-select input-field" id="allow_pets_charges" name="allow_pets_charges" required>
                        <option value="">Select</option>
                        <option value="yes" {{ old('allow_pets_charges') == 'yes' ? "selected" : "" }}>Charges may apply</option>
                        <option value="no" {{ old('allow_pets_charges') == 'no' ? "selected" : "" }}>Pets can stay for free</option>
                    </select>
                    <x-input-error field="allow_pets_charges"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <x-upload-image-must old_name="old_thumbnail" old_value="{{ old('thumbnail') }}" new_name="new_thumbnail" path="stays" label="Thumbnail"></x-upload-image-must>
                    <x-input-error field="new_thumbnail"></x-input-error>
                </div>

                <div class="col-12 mb-3 mb-md-4">
                    <x-upload-multi-images image_count="10" old_name="old_images" old_value="{{ old('images') }}" new_name="new_images[]" path="stays" label="Images"></x-upload-multi-images>
                    <x-input-error field="new_images.*"></x-input-error>
                </div>

                <x-create-status></x-create>
            </div>
        </form>
    </div>
@endsection

@push('after-scripts')
    <script>(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
        ({key: "{{ config("services.google_maps.key") }}", v: "weekly"});</script>

    <script src="{{ asset('js/google-map.js') }}"></script>

    <script>
        $(document).ready(function() {
            function toggleBreakfast() {
                let breakfastValue = $('#breakfast').val();

                if(breakfastValue === 'yes') {
                    $('.breakfast-pay').removeClass('d-none').find('select').attr('required', true);
                    $('.breakfast-types').removeClass('d-none');
                }
                else {
                    $('.breakfast-pay').addClass('d-none').find('select').attr('required', false).val('').trigger('change');
                    $('.breakfast-types').addClass('d-none').find('input[type="checkbox"]').prop('checked', false);
                }
            }

            function toggleBreakfastPay() {
                let breakfastPayValue = $('#breakfast_pay').val();

                if(breakfastPayValue === 'no') {
                    $('.breakfast-cost').removeClass('d-none').find('input').attr('required', true);
                }
                else {
                    $('.breakfast-cost').addClass('d-none').find('input').attr('required', false).val('');
                }
            }

            function toggleParking() {
                let parkingValue = $('#parking').val();

                if(parkingValue === 'yes_paid') {
                    $('.parking-reserve').removeClass('d-none').find('select').attr('required', true);
                    $('.parking-location').removeClass('d-none').find('select').attr('required', true);
                    $('.parking-type').removeClass('d-none').find('select').attr('required', true);
                    $('.parking-cost').removeClass('d-none').find('input').attr('required', true);
                    $('.parking-cost-type').removeClass('d-none').find('select').attr('required', true);
                }
                else if(parkingValue === 'yes_free') {
                    $('.parking-reserve').removeClass('d-none').find('select').attr('required', true);
                    $('.parking-location').removeClass('d-none').find('select').attr('required', true);
                    $('.parking-type').removeClass('d-none').find('select').attr('required', true);

                    $('.parking-cost').addClass('d-none').find('input').attr('required', false).val('');
                    $('.parking-cost-type').addClass('d-none').find('select').attr('required', false).val('');
                }
                else {
                    $('.parking-reserve').addClass('d-none').find('select').attr('required', false).val('');
                    $('.parking-location').addClass('d-none').find('select').attr('required', false).val('');
                    $('.parking-type').addClass('d-none').find('select').attr('required', false).val('');
                    $('.parking-cost').addClass('d-none').find('input').attr('required', false).val('');
                    $('.parking-cost-type').addClass('d-none').find('select').attr('required', false).val('');
                }
            }

            function toggleAllowPets() {
                let allowPetsValue = $('#allow_pets').val();

                if(allowPetsValue === 'yes') {
                    $('.allow-pets-charges').removeClass('d-none').find('select').attr('required', true);
                }
                else {
                    $('.allow-pets-charges').addClass('d-none').find('select').attr('required', false).val('');
                }
            }

            $('#breakfast').on('change', toggleBreakfast);
            $('#breakfast_pay').on('change', toggleBreakfastPay);
            $('#parking').on('change', toggleParking);
            $('#allow_pets').on('change', toggleAllowPets);

            toggleBreakfast();
            toggleBreakfastPay();
            toggleParking();
            toggleAllowPets();
        });
    </script>
@endpush