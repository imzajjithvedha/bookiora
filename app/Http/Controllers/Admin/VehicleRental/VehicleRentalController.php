<?php

namespace App\Http\Controllers\Admin\VehicleRental;

use App\Http\Controllers\Controller;
use App\Models\StorageType;
use App\Models\User;
use App\Models\Stay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VehicleRentalController extends Controller
{
    private function processData($items)
    {
        foreach($items as $item) {
            $item->action = '
            <a href="'. route('admin.stays.edit', $item->id) .'" class="action-button" title="Edit"><i class="bi bi-pencil-square"></i></a>
            <a href="'. route('admin.users.edit', $item->user_id) .'" class="action-button" title="User"><i class="bi bi-person-exclamation"></i></a>
            <a id="'.$item->id.'" class="action-button delete-button" title="Delete"><i class="bi bi-trash3"></i></a>';

            switch($item->status) {
                case 2:
                    $item->status = '<span class="status active-status">Active</span>';
                    break;

                case 1:
                    $item->status = '<span class="status pending-status">Pending</span>';
                    break;

                default:
                    $item->status = '<span class="status inactive-status">Inactive</span>';
                    break;
            }
        }

        return $items;
    }

    public function index(Request $request)
    {
        $pagination = $request->pagination ?? 10;

        Stay::where('is_new', 1)->update(['is_new' => 0]);
        
        $items = Stay::orderBy('id', 'desc')->paginate($pagination);
        $items = $this->processData($items);

        return view('admin.stays.index', [
            'items' => $items,
            'pagination' => $pagination
        ]);
    }

    public function create()
    {
        $users = User::where('status', 1)->where('role', 'partner')->get();
        $countries = [
            "Afghanistan",
            "Aland Islands",
            "Albania",
            "Algeria",
            "American Samoa",
            "Andorra",
            "Angola",
            "Anguilla",
            "Antarctica",
            "Antigua and Barbuda",
            "Argentina",
            "Armenia",
            "Aruba",
            "Australia",
            "Austria",
            "Azerbaijan",
            "Bahamas",
            "Bahrain",
            "Bangladesh",
            "Barbados",
            "Belarus",
            "Belgium",
            "Belize",
            "Benin",
            "Bermuda",
            "Bhutan",
            "Bolivia",
            "Bonaire, Sint Eustatius and Saba",
            "Bosnia and Herzegovina",
            "Botswana",
            "Bouvet Island",
            "Brazil",
            "British Indian Ocean Territory",
            "Brunei Darussalam",
            "Bulgaria",
            "Burkina Faso",
            "Burundi",
            "Cambodia",
            "Cameroon",
            "Canada",
            "Cape Verde",
            "Cayman Islands",
            "Central African Republic",
            "Chad",
            "Chile",
            "China",
            "Christmas Island",
            "Cocos (Keeling) Islands",
            "Colombia",
            "Comoros",
            "Congo",
            "Congo, Democratic Republic of the Congo",
            "Cook Islands",
            "Costa Rica",
            "Cote D'Ivoire",
            "Croatia",
            "Cuba",
            "Curacao",
            "Cyprus",
            "Czech Republic",
            "Denmark",
            "Djibouti",
            "Dominica",
            "Dominican Republic",
            "Ecuador",
            "Egypt",
            "El Salvador",
            "Equatorial Guinea",
            "Eritrea",
            "Estonia",
            "Ethiopia",
            "Falkland Islands (Malvinas)",
            "Faroe Islands",
            "Fiji",
            "Finland",
            "France",
            "French Guiana",
            "French Polynesia",
            "French Southern Territories",
            "Gabon",
            "Gambia",
            "Georgia",
            "Germany",
            "Ghana",
            "Gibraltar",
            "Greece",
            "Greenland",
            "Grenada",
            "Guadeloupe",
            "Guam",
            "Guatemala",
            "Guernsey",
            "Guinea",
            "Guinea-Bissau",
            "Guyana",
            "Haiti",
            "Heard Island and Mcdonald Islands",
            "Holy See (Vatican City State)",
            "Honduras",
            "Hong Kong",
            "Hungary",
            "Iceland",
            "India",
            "Indonesia",
            "Iran, Islamic Republic of",
            "Iraq",
            "Ireland",
            "Isle of Man",
            "Israel",
            "Italy",
            "Jamaica",
            "Japan",
            "Jersey",
            "Jordan",
            "Kazakhstan",
            "Kenya",
            "Kiribati",
            "Korea, Democratic People's Republic of",
            "Korea, Republic of",
            "Kosovo",
            "Kuwait",
            "Kyrgyzstan",
            "Lao People's Democratic Republic",
            "Latvia",
            "Lebanon",
            "Lesotho",
            "Liberia",
            "Libyan Arab Jamahiriya",
            "Liechtenstein",
            "Lithuania",
            "Luxembourg",
            "Macao",
            "Macedonia, the Former Yugoslav Republic of",
            "Madagascar",
            "Malawi",
            "Malaysia",
            "Maldives",
            "Mali",
            "Malta",
            "Marshall Islands",
            "Martinique",
            "Mauritania",
            "Mauritius",
            "Mayotte",
            "Mexico",
            "Micronesia, Federated States of",
            "Moldova, Republic of",
            "Monaco",
            "Mongolia",
            "Montenegro",
            "Montserrat",
            "Morocco",
            "Mozambique",
            "Myanmar",
            "Namibia",
            "Nauru",
            "Nepal",
            "Netherlands",
            "Netherlands Antilles",
            "New Caledonia",
            "New Zealand",
            "Nicaragua",
            "Niger",
            "Nigeria",
            "Niue",
            "Norfolk Island",
            "Northern Mariana Islands",
            "Norway",
            "Oman",
            "Pakistan",
            "Palau",
            "Palestinian Territory, Occupied",
            "Panama",
            "Papua New Guinea",
            "Paraguay",
            "Peru",
            "Philippines",
            "Pitcairn",
            "Poland",
            "Portugal",
            "Puerto Rico",
            "Qatar",
            "Reunion",
            "Romania",
            "Russian Federation",
            "Rwanda",
            "Saint Barthelemy",
            "Saint Helena",
            "Saint Kitts and Nevis",
            "Saint Lucia",
            "Saint Martin",
            "Saint Pierre and Miquelon",
            "Saint Vincent and the Grenadines",
            "Samoa",
            "San Marino",
            "Sao Tome and Principe",
            "Saudi Arabia",
            "Senegal",
            "Serbia",
            "Serbia and Montenegro",
            "Seychelles",
            "Sierra Leone",
            "Singapore",
            "Sint Maarten",
            "Slovakia",
            "Slovenia",
            "Solomon Islands",
            "Somalia",
            "South Africa",
            "South Georgia and the South Sandwich Islands",
            "South Sudan",
            "Spain",
            "Sri Lanka",
            "Sudan",
            "Suriname",
            "Svalbard and Jan Mayen",
            "Swaziland",
            "Sweden",
            "Switzerland",
            "Syrian Arab Republic",
            "Taiwan, Province of China",
            "Tajikistan",
            "Tanzania, United Republic of",
            "Thailand",
            "Timor-Leste",
            "Togo",
            "Tokelau",
            "Tonga",
            "Trinidad and Tobago",
            "Tunisia",
            "Turkey",
            "Turkmenistan",
            "Turks and Caicos Islands",
            "Tuvalu",
            "Uganda",
            "Ukraine",
            "United Arab Emirates",
            "United Kingdom",
            "United States",
            "United States Minor Outlying Islands",
            "Uruguay",
            "Uzbekistan",
            "Vanuatu",
            "Venezuela",
            "Viet Nam",
            "Virgin Islands, British",
            "Virgin Islands, U.s.",
            "Wallis and Futuna",
            "Western Sahara",
            "Yemen",
            "Zambia",
            "Zimbabwe"
        ];

        return view('admin.stays.create', [
            'users' => $users,
            'countries' => $countries
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required|min:0|max:255',
            'description_en' => 'required',
            'address_name' => 'required|min:0|max:255',
            'address_en' => 'required|min:0|max:255',
            'city_en' => 'required|min:0|max:255',
            'address_ar' => 'required|min:0|max:255',
            'city_ar' => 'required|min:0|max:255',
            'latitude' => 'required|min:0|max:255',
            'longitude' => 'required|min:0|max:255',
            'user_id' => 'required|integer',
            'storage_type_id' => 'required|integer',
            'total_area' => 'required',
            'total_pallets' => 'required|integer',
            'available_pallets' => 'required|integer',
            'rent_per_pallet' => 'required|numeric',
            'pallet_dimension' => 'required|in:120x80x150,120x100x150,other',
            'temperature_type' => 'required|in:dry,ambient,cold,freezer',
            'temperature_range' => 'required',
            'wms' => 'required|in:yes,no',
            'equipment_handling' => 'required|in:yes,no',
            'temperature_sensor' => 'required|in:yes,no',
            'humidity_sensor' => 'required|in:yes,no',
            'new_thumbnail' => 'max:30720',
            'new_outside_image' => 'max:30720',
            'new_loading_image' => 'max:30720',
            'new_off_loading_image' => 'max:30720',
            'new_handling_equipment_image' => 'max:30720',
            'new_storage_area_image' => 'max:30720',
            'new_videos.*' => 'max:204800',
            'new_licenses.*' => 'max:30720',
            'status' => 'required|in:0,1,2'
        ], [
            'address_name' => 'Address field is required.',
            'address_en' => 'Address field is required.',
            'city_en' => 'Address field is required.',
            'address_ar' => 'Address field is required.',
            'city_ar' => 'Address field is required.',
            'latitude' => 'Address field is required.',
            'longitude' => 'Address field is required.',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Creation Failed!',
                'route' => route('admin.stays.index')
            ]);
        }

        if($request->file('new_thumbnail')) {
            $thumbnail = $request->file('new_thumbnail');
            $thumbnail_name = Str::random(40) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('backend/stays', $thumbnail_name);
        }
        else {
            $thumbnail_name = $request->old_thumbnail;
        }

        if($request->file('new_outside_image')) {
            $outside_image = $request->file('new_outside_image');
            $outside_image_name = Str::random(40) . '.' . $outside_image->getClientOriginalExtension();
            $outside_image->storeAs('backend/stays', $outside_image_name);
        }
        else {
            $outside_image_name = $request->old_outside_image;
        }

        if($request->file('new_loading_image')) {
            $loading_image = $request->file('new_loading_image');
            $loading_image_name = Str::random(40) . '.' . $loading_image->getClientOriginalExtension();
            $loading_image->storeAs('backend/stays', $loading_image_name);
        }
        else {
            $loading_image_name = $request->old_loading_image;
        }

        if($request->file('new_off_loading_image')) {
            $off_loading_image = $request->file('new_off_loading_image');
            $off_loading_image_name = Str::random(40) . '.' . $off_loading_image->getClientOriginalExtension();
            $off_loading_image->storeAs('backend/stays', $off_loading_image_name);
        }
        else {
            $off_loading_image_name = $request->old_off_loading_image;
        }

        if($request->file('new_handling_equipment_image')) {
            $handling_equipment_image = $request->file('new_handling_equipment_image');
            $handling_equipment_image_name = Str::random(40) . '.' . $handling_equipment_image->getClientOriginalExtension();
            $handling_equipment_image->storeAs('backend/stays', $handling_equipment_image_name);
        }
        else {
            $handling_equipment_image_name = $request->old_handling_equipment_image;
        }

        if($request->file('new_storage_area_image')) {
            $storage_area_image = $request->file('new_storage_area_image');
            $storage_area_image_name = Str::random(40) . '.' . $storage_area_image->getClientOriginalExtension();
            $storage_area_image->storeAs('backend/stays', $storage_area_image_name);
        }
        else {
            $storage_area_image_name = $request->old_storage_area_image;
        }

        $new_videos = [];
        if($request->file('new_videos')) {
            foreach($request->file('new_videos') as $video) {
                $video_name = Str::random(40) . '.' . $video->getClientOriginalExtension();
                $video->storeAs('backend/stays', $video_name);
                $new_videos[] = $video_name;
            }
        }

        $new_licenses = [];
        if($request->file('new_licenses')) {
            foreach($request->file('new_licenses') as $license) {
                $license_name = Str::random(40) . '.' . $license->getClientOriginalExtension();
                $license->storeAs('backend/stays', $license_name);
                $new_licenses[] = $license_name;
            }
        }

        // Features EN
            $features_en = [];
            if($request->feature_titles_en) {
                foreach($request->feature_titles_en as $key => $title) {
                    array_push($features_en, [
                        'title' => $title,
                        'description' => $request->feature_descriptions_en[$key] ?? null
                    ]);
                }
            }
            $features_en = $features_en ? json_encode($features_en) : null;
        // Features EN

        // Features AR
            $features_ar = [];
            if($request->feature_titles_ar) {
                foreach($request->feature_titles_ar as $key => $title) {
                    array_push($features_ar, [
                        'title' => $title,
                        'description' => $request->feature_descriptions_ar[$key] ?? null
                    ]);
                }
            }
            $features_ar = $features_ar ? json_encode($features_ar) : null;
        // Features AR

        // Amenities EN
            $amenities_en = [];
            if($request->amenity_titles_en) {
                foreach($request->amenity_titles_en as $key => $title) {
                    array_push($amenities_en, [
                        'title' => $title,
                        'description' => $request->amenity_descriptions_en[$key] ?? null
                    ]);
                }
            }
            $amenities_en = $amenities_en ? json_encode($amenities_en) : null;
        // Amenities EN

        // Amenities AR
            $amenities_ar = [];
            if($request->amenity_titles_ar) {
                foreach($request->amenity_titles_ar as $key => $title) {
                    array_push($amenities_ar, [
                        'title' => $title,
                        'description' => $request->amenity_descriptions_ar[$key] ?? null
                    ]);
                }
            }
            $amenities_ar = $amenities_ar ? json_encode($amenities_ar) : null;
        // Amenities AR

        // Details EN
            $details_en = [];
            if($request->detail_titles_en) {
                foreach($request->detail_titles_en as $key => $title) {
                    array_push($details_en, [
                        'title' => $title,
                        'description' => $request->detail_descriptions_en[$key] ?? null
                    ]);
                }
            }
            $details_en = $details_en ? json_encode($details_en) : null;
        // Details EN

        // Details AR
            $details_ar = [];
            if($request->detail_titles_ar) {
                foreach($request->detail_titles_ar as $key => $title) {
                    array_push($details_ar, [
                        'title' => $title,
                        'description' => $request->detail_descriptions_ar[$key] ?? null
                    ]);
                }
            }
            $details_ar = $details_ar ? json_encode($details_ar) : null;
        // Details AR

        $data = $request->except(
            'old_thumbnail',
            'new_thumbnail',
            'old_outside_image',
            'new_outside_image',
            'old_loading_image',
            'new_loading_image',
            'old_off_loading_image',
            'new_off_loading_image',
            'old_handling_equipment_image',
            'new_handling_equipment_image',
            'old_storage_area_image',
            'new_storage_area_image',
            'old_videos',
            'new_videos',
            'old_licenses',
            'new_licenses',
            'feature_titles_en',
            'feature_descriptions_en',
            'feature_titles_ar',
            'feature_descriptions_ar',
            'amenity_titles_en',
            'amenity_descriptions_en',
            'amenity_titles_ar',
            'amenity_descriptions_ar',
            'detail_titles_en',
            'detail_descriptions_en',
            'detail_titles_ar',
            'detail_descriptions_ar',
        );
        $data['thumbnail'] = $thumbnail_name;
        $data['outside_image'] = $outside_image_name;
        $data['loading_image'] = $loading_image_name;
        $data['off_loading_image'] = $off_loading_image_name;
        $data['handling_equipment_image'] = $handling_equipment_image_name;
        $data['storage_area_image'] = $storage_area_image_name;
        $data['videos'] = $new_videos ? json_encode($new_videos) : null;
        $data['licenses'] = $new_licenses ? json_encode($new_licenses) : null;
        $data['features_en'] = $features_en;
        $data['features_ar'] = $features_ar;
        $data['amenities_en'] = $amenities_en;
        $data['amenities_ar'] = $amenities_ar;
        $data['details_en'] = $details_en;
        $data['details_ar'] = $details_ar;
        $stay = Stay::create($data);  

        return redirect()->route('admin.stays.edit', $stay)->with([
            'success' => "Update Successful!",
            'route' => route('admin.stays.index')
        ]);
    }

    public function edit(Stay $stay)
    {
        $users = User::where('status', 1)->where('role', 'landlord')->get();
        $storage_types = StorageType::where('status', 1)->get();

        return view('backend.admin.stays.edit', [
            'stay' => $stay,
            'users' => $users,
            'storage_types' => $storage_types
        ]);
    }

    public function update(Request $request, Stay $stay)
    {
        $validator = Validator::make($request->all(), [
            'name_en' => 'required|min:0|max:255',
            'description_en' => 'required',
            'address_name' => 'required|min:0|max:255',
            'address_en' => 'required|min:0|max:255',
            'city_en' => 'required|min:0|max:255',
            'address_ar' => 'required|min:0|max:255',
            'city_ar' => 'required|min:0|max:255',
            'latitude' => 'required|min:0|max:255',
            'longitude' => 'required|min:0|max:255',
            'user_id' => 'required|integer',
            'storage_type_id' => 'required|integer',
            'total_area' => 'required',
            'total_pallets' => 'required|integer',
            'rent_per_pallet' => 'required|numeric',
            'available_pallets' => 'required|integer',
            'pallet_dimension' => 'required|in:120x80x150,120x100x150,other',
            'temperature_type' => 'required|in:dry,ambient,cold,freezer',
            'temperature_range' => 'required',
            'wms' => 'required|in:yes,no',
            'equipment_handling' => 'required|in:yes,no',
            'temperature_sensor' => 'required|in:yes,no',
            'humidity_sensor' => 'required|in:yes,no',
            'new_thumbnail' => 'max:30720',
            'new_outside_image' => 'max:30720',
            'new_loading_image' => 'max:30720',
            'new_off_loading_image' => 'max:30720',
            'new_handling_equipment_image' => 'max:30720',
            'new_storage_area_image' => 'max:30720',
            'new_videos.*' => 'max:204800',
            'new_licenses.*' => 'max:30720',
            'status' => 'required|in:0,1,2'
        ], [
            'address_name' => 'Address field is required.',
            'address_en' => 'Address field is required.',
            'city_en' => 'Address field is required.',
            'address_ar' => 'Address field is required.',
            'city_ar' => 'Address field is required.',
            'latitude' => 'Address field is required.',
            'longitude' => 'Address field is required.',
        ]);

        if($validator->fails()) {
            dd($validator);

            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Update Failed!',
                'route' => route('admin.stays.index')
            ]);
        }

        if($request->file('new_thumbnail')) {
            if($request->old_thumbnail) {
                Storage::delete('backend/stays/' . $request->old_thumbnail);
            }

            $thumbnail = $request->file('new_thumbnail');
            $thumbnail_name = Str::random(40) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('backend/stays', $thumbnail_name);
        }
        else if($request->old_thumbnail == null) {
            if($stay->thumbnail) {
                Storage::delete('backend/stays/' . $stay->thumbnail);
            }
            $thumbnail_name = null;
        }
        else {
            $thumbnail_name = $request->old_thumbnail;
        }

        if($request->file('new_outside_image')) {
            if($request->old_outside_image) {
                Storage::delete('backend/stays/' . $request->old_outside_image);
            }

            $outside_image = $request->file('new_outside_image');
            $outside_image_name = Str::random(40) . '.' . $outside_image->getClientOriginalExtension();
            $outside_image->storeAs('backend/stays', $outside_image_name);
        }
        else if($request->old_outside_image == null) {
            if($stay->outside_image) {
                Storage::delete('backend/stays/' . $stay->outside_image);
            }
            $outside_image_name = null;
        }
        else {
            $outside_image_name = $request->old_outside_image;
        }

        if($request->file('new_loading_image')) {
            if($request->old_loading_image) {
                Storage::delete('backend/stays/' . $request->old_loading_image);
            }

            $loading_image = $request->file('new_loading_image');
            $loading_image_name = Str::random(40) . '.' . $loading_image->getClientOriginalExtension();
            $loading_image->storeAs('backend/stays', $loading_image_name);
        }
        else if($request->old_loading_image == null) {
            if($stay->loading_image) {
                Storage::delete('backend/stays/' . $stay->loading_image);
            }
            $loading_image_name = null;
        }
        else {
            $loading_image_name = $request->old_loading_image;
        }

        if($request->file('new_off_loading_image')) {
            if($request->old_off_loading_image) {
                Storage::delete('backend/stays/' . $request->old_off_loading_image);
            }

            $off_loading_image = $request->file('new_off_loading_image');
            $off_loading_image_name = Str::random(40) . '.' . $off_loading_image->getClientOriginalExtension();
            $off_loading_image->storeAs('backend/stays', $off_loading_image_name);
        }
        else if($request->old_off_loading_image == null) {
            if($stay->off_loading_image) {
                Storage::delete('backend/stays/' . $stay->off_loading_image);
            }
            $off_loading_image_name = null;
        }
        else {
            $off_loading_image_name = $request->old_off_loading_image;
        }

        if($request->file('new_handling_equipment_image')) {
            if($request->old_handling_equipment_image) {
                Storage::delete('backend/stays/' . $request->old_handling_equipment_image);
            }

            $handling_equipment_image = $request->file('new_handling_equipment_image');
            $handling_equipment_image_name = Str::random(40) . '.' . $handling_equipment_image->getClientOriginalExtension();
            $handling_equipment_image->storeAs('backend/stays', $handling_equipment_image_name);
        }
        else if($request->old_handling_equipment_image == null) {
            if($stay->handling_equipment_image) {
                Storage::delete('backend/stays/' . $stay->handling_equipment_image);
            }
            $handling_equipment_image_name = null;
        }
        else {
            $handling_equipment_image_name = $request->old_handling_equipment_image;
        }

        if($request->file('new_storage_area_image')) {
            if($request->old_storage_area_image) {
                Storage::delete('backend/stays/' . $request->old_storage_area_image);
            }

            $storage_area_image = $request->file('new_storage_area_image');
            $storage_area_image_name = Str::random(40) . '.' . $storage_area_image->getClientOriginalExtension();
            $storage_area_image->storeAs('backend/stays', $storage_area_image_name);
        }
        else if($request->old_storage_area_image == null) {
            if($stay->storage_area_image) {
                Storage::delete('backend/stays/' . $stay->storage_area_image);
            }
            $storage_area_image_name = null;
        }
        else {
            $storage_area_image_name = $request->old_storage_area_image;
        }

        // Videos
            $existing_videos = json_decode($stay->videos ?? '[]', true);
            $current_videos  = json_decode(htmlspecialchars_decode($request->old_videos ?? '[]'), true);

            foreach(array_diff($existing_videos, $current_videos) as $video) {
                Storage::delete('backend/stays/' . $video);
            }

            if($request->file('new_videos')) {
                foreach($request->file('new_videos') as $video) {
                    $video_name = Str::random(40) . '.' . $video->getClientOriginalExtension();
                    $video->storeAs('backend/stays', $video_name);
                    $current_videos[] = $video_name;
                }
            }
            
            $videos = $current_videos ? json_encode($current_videos) : null;
        // Videos

        // Licenses
            $existing_licenses = json_decode($stay->licenses ?? '[]', true);
            $current_licenses  = json_decode(htmlspecialchars_decode($request->old_licenses ?? '[]'), true);

            foreach(array_diff($existing_licenses, $current_licenses) as $license) {
                Storage::delete('backend/stays/' . $license);
            }

            if($request->file('new_licenses')) {
                foreach($request->file('new_licenses') as $license) {
                    $license_name = Str::random(40) . '.' . $license->getClientOriginalExtension();
                    $license->storeAs('backend/stays', $license_name);
                    $current_licenses[] = $license_name;
                }
            }
            
            $licenses = $current_licenses ? json_encode($current_licenses) : null;
        // Licenses

        // Features EN
            $features_en = [];
            if($request->feature_titles_en) {
                foreach($request->feature_titles_en as $key => $title) {
                    array_push($features_en, [
                        'title' => $title,
                        'description' => $request->feature_descriptions_en[$key] ?? null
                    ]);
                }
            }
            $features_en = $features_en ? json_encode($features_en) : null;
        // Features EN

        // Features AR
            $features_ar = [];
            if($request->feature_titles_ar) {
                foreach($request->feature_titles_ar as $key => $title) {
                    array_push($features_ar, [
                        'title' => $title,
                        'description' => $request->feature_descriptions_ar[$key] ?? null
                    ]);
                }
            }
            $features_ar = $features_ar ? json_encode($features_ar) : null;
        // Features AR

        // Amenities EN
            $amenities_en = [];
            if($request->amenity_titles_en) {
                foreach($request->amenity_titles_en as $key => $title) {
                    array_push($amenities_en, [
                        'title' => $title,
                        'description' => $request->amenity_descriptions_en[$key] ?? null
                    ]);
                }
            }
            $amenities_en = $amenities_en ? json_encode($amenities_en) : null;
        // Amenities EN

        // Amenities AR
            $amenities_ar = [];
            if($request->amenity_titles_ar) {
                foreach($request->amenity_titles_ar as $key => $title) {
                    array_push($amenities_ar, [
                        'title' => $title,
                        'description' => $request->amenity_descriptions_ar[$key] ?? null
                    ]);
                }
            }
            $amenities_ar = $amenities_ar ? json_encode($amenities_ar) : null;
        // Amenities AR

        // Details EN
            $details_en = [];
            if($request->detail_titles_en) {
                foreach($request->detail_titles_en as $key => $title) {
                    array_push($details_en, [
                        'title' => $title,
                        'description' => $request->detail_descriptions_en[$key] ?? null
                    ]);
                }
            }
            $details_en = $details_en ? json_encode($details_en) : null;
        // Details EN

        // Details AR
            $details_ar = [];
            if($request->detail_titles_ar) {
                foreach($request->detail_titles_ar as $key => $title) {
                    array_push($details_ar, [
                        'title' => $title,
                        'description' => $request->detail_descriptions_ar[$key] ?? null
                    ]);
                }
            }
            $details_ar = $details_ar ? json_encode($details_ar) : null;
        // Details AR

        $data = $request->except(
            'old_thumbnail',
            'new_thumbnail',
            'old_outside_image',
            'new_outside_image',
            'old_loading_image',
            'new_loading_image',
            'old_off_loading_image',
            'new_off_loading_image',
            'old_handling_equipment_image',
            'new_handling_equipment_image',
            'old_storage_area_image',
            'new_storage_area_image',
            'old_videos',
            'new_videos',
            'old_licenses',
            'new_licenses',
            'feature_titles_en',
            'feature_descriptions_en',
            'feature_titles_ar',
            'feature_descriptions_ar',
            'amenity_titles_en',
            'amenity_descriptions_en',
            'amenity_titles_ar',
            'amenity_descriptions_ar',
            'detail_titles_en',
            'detail_descriptions_en',
            'detail_titles_ar',
            'detail_descriptions_ar',
        );

        $data['thumbnail'] = $thumbnail_name;
        $data['outside_image'] = $outside_image_name;
        $data['loading_image'] = $loading_image_name;
        $data['off_loading_image'] = $off_loading_image_name;
        $data['handling_equipment_image'] = $handling_equipment_image_name;
        $data['storage_area_image'] = $storage_area_image_name;
        $data['videos'] = $videos;
        $data['licenses'] = $licenses;
        $data['features_en'] = $features_en;
        $data['features_ar'] = $features_ar;
        $data['amenities_en'] = $amenities_en;
        $data['amenities_ar'] = $amenities_ar;
        $data['details_en'] = $details_en;
        $data['details_ar'] = $details_ar;
        $stay->fill($data)->save();
        
        return redirect()->back()->with([
            'success' => "Update Successful!",
            'route' => route('admin.stays.index')
        ]);
    }

    public function destroy(Stay $stay)
    {
        $stay->delete();

        return redirect()->back()->with('delete', 'Successfully Deleted!');
    }

    public function filter(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $status = $request->status;
        $column = $request->column ?? 'id';
        $direction = $request->direction ?? 'desc';

        $valid_columns = ['name_en', 'address_en', 'total_area', 'total_pallets', 'status', 'id'];
        $valid_directions = ['asc', 'desc'];

        if(!in_array($column, $valid_columns)) {
            $column = 'id';
        }

        if(!in_array($direction, $valid_directions)) {
            $direction = 'desc';
        }

        $items = Stay::orderBy($column, $direction);

        if($name) {
            $items->where(function ($query) use ($name) {
                $query->where('name_en', 'like', '%' . $name . '%')
                    ->orWhere('name_ar', 'like', '%' . $name . '%');
            });
        }

        if($address) {
            $items->where(function($data) use ($address) {
                $data->where('address_en', 'like', "%{$address}%")
                ->orWhere('address_ar', 'like', "%{$address}%");
            });
        }

        if($status != null) {
            $items->where('status', $status);
        }

        $pagination = $request->pagination ?? 10;
        $items = $items->paginate($pagination);
        $items = $this->processData($items);

        if($request->ajax()) {
            $tbodyView = view('backend.admin.stays._tbody', compact('items'))->render();
            $paginationView = $items->appends($request->except('page'))->links("pagination::bootstrap-5")->render();

            return response()->json([
                'tbody' => $tbodyView,
                'pagination' => $paginationView,
            ]);
        }

        return view('backend.admin.stays.index', [
            'items' => $items,
            'pagination' => $pagination,
            'name' => $name,
            'address' => $address,
            'status' => $status
        ]);
    }
}