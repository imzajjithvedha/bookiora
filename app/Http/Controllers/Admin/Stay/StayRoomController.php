<?php

namespace App\Http\Controllers\Admin\Stay;

use App\Http\Controllers\Controller;
use App\Models\Stay;
use App\Models\StayRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StayRoomController extends Controller
{
    private function processData($items)
    {
        foreach($items as $item) {
            $item->action = '
            <a href="'. route('admin.stays.rooms.edit', [$item->stay_id, $item->id]) .'" class="action-button" title="Edit"><i class="bi bi-pencil-square"></i></a>
            <a id="'.$item->id.'" class="action-button delete-button" title="Delete"><i class="bi bi-trash3"></i></a>';

            $item->thumbnail = '<img src="'. asset('storage/backend/stays/' . $item->thumbnail) .'" class="table-image">';

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

    public function index(Request $request, Stay $stay)
    {
        $pagination = $request->pagination ?? 10;

        $stay->rooms()->where('is_new', 1)->update(['is_new' => 0]);
        
        $items = $stay->rooms()->orderBy('id', 'desc')->paginate($pagination);
        $items = $this->processData($items);

        return view('admin.stays.rooms.index', [
            'stay' => $stay,
            'items' => $items,
            'pagination' => $pagination
        ]);
    }

    public function create(Stay $stay)
    {
        return view('admin.stays.rooms.create', [
            'stay' => $stay
        ]);
    }
    
    public function store(Request $request, Stay $stay)
    {
        $names = [
                'Double Room',
                'Double Room with Private Bathroom',
                'Budget Double Room',
                'Business Double Room with Gym Access',
                'Deluxe Double Room',
                'Deluxe Double Room (1 adult + 1 child)',
                'Deluxe Double Room (1 adult + 2 children)',
                'Deluxe Double Room (2 Adults + 1 Child)',
                'Deluxe Double Room with Balcony',
                'Deluxe Double Room with Balcony and Sea View',
                'Deluxe Double Room with Bath',
                'Deluxe Double Room with Castle View',
                'Deluxe Double Room with Extra Bed',
                'Deluxe Double Room with Sea View',
                'Deluxe Double Room with Shower',
                'Deluxe Double Room with Side Sea View',
                'Deluxe Double or Twin Room',
                'Deluxe King Room',
                'Deluxe Queen Room',
                'Deluxe Room',
                'Deluxe Room (1 adult + 1 child)',
                'Deluxe Room (1 adult + 2 children)',
                'Deluxe Room (2 Adults + 1 Child)',
                'Double Room (1 Adult + 1 Child)',
                'Double Room - Disability Access',
                'Double Room with Balcony',
                'Double Room with Balcony (2 Adults + 1 Child)',
                'Double Room with Balcony (3 Adults)',
                'Double Room with Balcony and Sea View',
                'Double Room with Extra Bed',
                'Double Room with Garden View',
                'Double Room with Lake View',
                'Double Room with Mountain View',
                'Double Room with Patio',
                'Double Room with Pool View',
                'Double Room with Private External Bathroom',
                'Double Room with Sea View',
                'Double Room with Shared Bathroom',
                'Double Room with Shared Toilet',
                'Double Room with Spa Bath',
                'Double Room with Terrace',
                'Economy Double Room',
                'King Room',
                'King Room - Disability Access',
                'King Room with Balcony',
                'King Room with Garden View',
                'King Room with Lake View',
                'King Room with Mountain View',
                'King Room with Pool View',
                'King Room with Roll-In Shower - Disability Access',
                'King Room with Sea View',
                'King Room with Spa Bath',
                'Large Double Room',
                'Queen Room',
                'Queen Room - Disability Access',
                'Queen Room with Balcony',
                'Queen Room with Garden View',
                'Queen Room with Pool View',
                'Queen Room with Sea View',
                'Queen Room with Shared Bathroom',
                'Queen Room with Spa Bath',
                'Small Double Room',
                'Standard Double Room',
                'Standard Double Room with Fan',
                'Standard Double Room with Shared Bathroom',
                'Standard King Room',
                'Standard Queen Room',
                'Superior Double Room',
                'Superior King Room',
                'Superior Queen Room'
        ];

        $free_cancellation_windows = [
            'Before 18:00 on the day of arrival',
            'Up to 1 day before the day of arrival',
            'Up to 2 days before the day of arrival',
            'Up to 3 days before the day of arrival',
            'Up to 7 days before the day of arrival',
            'Up to 14 days before the day of arrival',
        ];

        $validator = Validator::make($request->all(), [
            'custom_name' => 'nullable|min:3|max:100',
            'name' => 'required|in:' . implode(',', $names),
            'type' => ['required', Rule::in(config('stayroomtypes.list'))],
            'number_of_rooms' => 'required|numeric|min:1',
            'single_bed_count' => 'required|numeric|min:0',
            'double_bed_count' => 'required|numeric|min:0',
            'large_bed_count' => 'required|numeric|min:0',
            'extra_large_double_bed_count' => 'required|numeric|min:0',
            'bunk_bed_count' => 'required|numeric|min:0',
            'sofa_bed_count' => 'required|numeric|min:0',
            'futon_mat_count' => 'required|numeric|min:0',
            'number_of_guests' => 'required|numeric|min:1',
            'smoking_allowed' => 'required|in:yes,no',
            'bathroom_private' => 'required|in:yes,no',

            'bathroom_items' => 'nullable|array',
            'bathroom_items.*' => Rule::in(config('stayroombathroomitems.list')),

            'general_amenities' => 'nullable|array',
            'general_amenities.*' => Rule::in(config('stayroomgeneralamenities.list')),

            'outdoor_views' => 'nullable|array',
            'outdoor_views.*' => Rule::in(config('stayroomoutdoorviews.list')),

            'food_drinks' => 'nullable|array',
            'food_drinks.*' => Rule::in(config('stayroomfooddrinks.list')),

            'charge_per_night' => 'required|numeric|min:0',

            'free_cancellation_window' => 'required|in:' . implode(',', $free_cancellation_windows),
            'windows_cancellation_payment' => 'required|in:Cost of the first night,100% of the total price',

            'non_refundable_rate_plan' => 'required|in:yes,no',
            'non_refundable_rate_discount' => 'required|numeric|min:0',

            'weekly_rate_plan' => 'required|in:yes,no',
            'weekly_rate_discount' => 'required|numeric|min:0',
            
            'new_thumbnail' => 'required|max:3072',

            'new_images' => 'nullable|array',
            'new_images.*' => 'max:3072',
            'status' => 'required|in:0,1,2'
        ], [
            'new_thumbnail.required' => 'The thumbnail is required.',
            'new_thumbnail.max' => 'The thumbnail must not be greater than 3072 kilobytes.',
            'new_images.*.max' => 'The image must not be greater than 3072 kilobytes.',

            'bathroom_items.*.in' => 'One or more selected bathroom items are invalid.',
            'general_amenities.*.in' => 'One or more selected general amenities are invalid.',
            'outdoor_views.*.in' => 'One or more selected outdoor views are invalid.',
            'food_drinks.*.in' => 'One or more selected food and drinks are invalid.',
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Creation failed',
                'message' => 'Your information has not been updated.'
            ]);
        }

        $thumbnail_name = null;
        if($request->file('new_thumbnail')) {
            $thumbnail = $request->file('new_thumbnail');
            $thumbnail_name = Str::random(40) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->storeAs('backend/stays', $thumbnail_name);
        }

        $new_images = [];
        if($request->file('new_images')) {
            foreach($request->file('new_images') as $image) {
                $image_name = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $image->storeAs('backend/stays', $image_name);
                $new_images[] = $image_name;
            }
        }

        $data = $request->except(
            'old_thumbnail',
            'new_thumbnail',
            'old_images',
            'new_images'
        );
        $data['stay_id'] = $stay->id;
        $data['thumbnail'] = $thumbnail_name;
        $data['images'] = $new_images ? json_encode($new_images) : null;
        $data['bathroom_items'] = $request->bathroom_items ? json_encode($request->bathroom_items) : null;
        $data['general_amenities'] = $request->general_amenities ? json_encode($request->general_amenities) : null;
        $data['outdoor_views'] = $request->outdoor_views ? json_encode($request->outdoor_views) : null;
        $data['food_drinks'] = $request->food_drinks ? json_encode($request->food_drinks) : null;

        $stay_room = StayRoom::create($data);  

        return redirect()->route('admin.stays.rooms.index', $stay)->with([
            'success' => 'Create successful',
            'message' => 'All changes have been successfully updated and saved.'
        ]);
    }

    public function edit(Stay $stay, StayRoom $stay_room)
    {
        return view('admin.stays.rooms.edit', [
            'stay' => $stay,
            'stay_room' => $stay_room
        ]);
    }

    public function update(Request $request, Stay $stay, StayRoom $stay_room)
    {
        $names = [
                'Double Room',
                'Double Room with Private Bathroom',
                'Budget Double Room',
                'Business Double Room with Gym Access',
                'Deluxe Double Room',
                'Deluxe Double Room (1 adult + 1 child)',
                'Deluxe Double Room (1 adult + 2 children)',
                'Deluxe Double Room (2 Adults + 1 Child)',
                'Deluxe Double Room with Balcony',
                'Deluxe Double Room with Balcony and Sea View',
                'Deluxe Double Room with Bath',
                'Deluxe Double Room with Castle View',
                'Deluxe Double Room with Extra Bed',
                'Deluxe Double Room with Sea View',
                'Deluxe Double Room with Shower',
                'Deluxe Double Room with Side Sea View',
                'Deluxe Double or Twin Room',
                'Deluxe King Room',
                'Deluxe Queen Room',
                'Deluxe Room',
                'Deluxe Room (1 adult + 1 child)',
                'Deluxe Room (1 adult + 2 children)',
                'Deluxe Room (2 Adults + 1 Child)',
                'Double Room (1 Adult + 1 Child)',
                'Double Room - Disability Access',
                'Double Room with Balcony',
                'Double Room with Balcony (2 Adults + 1 Child)',
                'Double Room with Balcony (3 Adults)',
                'Double Room with Balcony and Sea View',
                'Double Room with Extra Bed',
                'Double Room with Garden View',
                'Double Room with Lake View',
                'Double Room with Mountain View',
                'Double Room with Patio',
                'Double Room with Pool View',
                'Double Room with Private External Bathroom',
                'Double Room with Sea View',
                'Double Room with Shared Bathroom',
                'Double Room with Shared Toilet',
                'Double Room with Spa Bath',
                'Double Room with Terrace',
                'Economy Double Room',
                'King Room',
                'King Room - Disability Access',
                'King Room with Balcony',
                'King Room with Garden View',
                'King Room with Lake View',
                'King Room with Mountain View',
                'King Room with Pool View',
                'King Room with Roll-In Shower - Disability Access',
                'King Room with Sea View',
                'King Room with Spa Bath',
                'Large Double Room',
                'Queen Room',
                'Queen Room - Disability Access',
                'Queen Room with Balcony',
                'Queen Room with Garden View',
                'Queen Room with Pool View',
                'Queen Room with Sea View',
                'Queen Room with Shared Bathroom',
                'Queen Room with Spa Bath',
                'Small Double Room',
                'Standard Double Room',
                'Standard Double Room with Fan',
                'Standard Double Room with Shared Bathroom',
                'Standard King Room',
                'Standard Queen Room',
                'Superior Double Room',
                'Superior King Room',
                'Superior Queen Room'
        ];

        $free_cancellation_windows = [
            'Before 18:00 on the day of arrival',
            'Up to 1 day before the day of arrival',
            'Up to 2 days before the day of arrival',
            'Up to 3 days before the day of arrival',
            'Up to 7 days before the day of arrival',
            'Up to 14 days before the day of arrival',
        ];
        
        $validator = Validator::make($request->all(), [
            'custom_name' => 'nullable|min:3|max:100',
            'name' => 'required|in:' . implode(',', $names),
            'type' => ['required', Rule::in(config('stayroomtypes.list'))],
            'number_of_rooms' => 'required|numeric|min:1',
            'single_bed_count' => 'required|numeric|min:0',
            'double_bed_count' => 'required|numeric|min:0',
            'large_bed_count' => 'required|numeric|min:0',
            'extra_large_double_bed_count' => 'required|numeric|min:0',
            'bunk_bed_count' => 'required|numeric|min:0',
            'sofa_bed_count' => 'required|numeric|min:0',
            'futon_mat_count' => 'required|numeric|min:0',
            'number_of_guests' => 'required|numeric|min:1',
            'smoking_allowed' => 'required|in:yes,no',
            'bathroom_private' => 'required|in:yes,no',

            'bathroom_items' => 'nullable|array',
            'bathroom_items.*' => Rule::in(config('stayroombathroomitems.list')),

            'general_amenities' => 'nullable|array',
            'general_amenities.*' => Rule::in(config('stayroomgeneralamenities.list')),

            'outdoor_views' => 'nullable|array',
            'outdoor_views.*' => Rule::in(config('stayroomoutdoorviews.list')),

            'food_drinks' => 'nullable|array',
            'food_drinks.*' => Rule::in(config('stayroomfooddrinks.list')),

            'charge_per_night' => 'required|numeric|min:0',

            'free_cancellation_window' => 'required|in:' . implode(',', $free_cancellation_windows),
            'windows_cancellation_payment' => 'required|in:Cost of the first night,100% of the total price',

            'non_refundable_rate_plan' => 'required|in:yes,no',
            'non_refundable_rate_discount' => 'required|numeric|min:0',

            'weekly_rate_plan' => 'required|in:yes,no',
            'weekly_rate_discount' => 'required|numeric|min:0',
        
            'new_thumbnail' => 'nullable|max:3072',
            'new_images' => 'nullable|array',
            'new_images.*' => 'max:3072',
            'status' => 'required|in:0,1,2'
        ], [
            'new_thumbnail.max' => 'The thumbnail must not be greater than 3072 kilobytes.',
            'new_images.*.max' => 'The image must not be greater than 3072 kilobytes.',
            'bathroom_items.*.in' => 'One or more selected bathroom items are invalid.',
            'general_amenities.*.in' => 'One or more selected general amenities are invalid.',
            'outdoor_views.*.in' => 'One or more selected outdoor views are invalid.',
            'food_drinks.*.in' => 'One or more selected food and drinks are invalid.',
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Update failed',
                'message' => 'Your information has not been updated.'
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
        else {
            $thumbnail_name = $request->old_thumbnail;
        }

        // Images
            $existing_images = json_decode($stay_room->images ?? '[]', true);
            $current_images  = json_decode(htmlspecialchars_decode($request->old_images ?? '[]'), true);

            foreach(array_diff($existing_images, $current_images) as $image) {
                Storage::delete('backend/stays/' . $image);
            }

            if($request->file('new_images')) {
                foreach($request->file('new_images') as $image) {
                    $image_name = Str::random(40) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('backend/stays', $image_name);
                    $current_images[] = $image_name;
                }
            }
            
            $images = $current_images ? json_encode($current_images) : null;
        // Images

        $data = $request->except(
            'old_thumbnail',
            'new_thumbnail',
            'old_images',
            'new_images'
        );

        $data['thumbnail'] = $thumbnail_name;
        $data['images'] = $images;
        $data['bathroom_items'] = $request->bathroom_items ? json_encode($request->bathroom_items) : null;
        $data['general_amenities'] = $request->general_amenities ? json_encode($request->general_amenities) : null;
        $data['outdoor_views'] = $request->outdoor_views ? json_encode($request->outdoor_views) : null;
        $data['food_drinks'] = $request->food_drinks ? json_encode($request->food_drinks) : null;
        $stay_room->fill($data)->save();
        
        return redirect()->route('admin.stays.rooms.index', $stay)->with([
            'success' => 'Update successful',
            'message' => 'All changes have been successfully updated and saved.'
        ]);
    }

    public function destroy(Stay $stay, StayRoom $stay_room)
    {
        $stay_room->delete();

        return redirect()->back()->with([
            'success' => 'Successfully deleted',
            'message' => 'This information is removed from the system.'
        ]);
    }

    public function filter(Request $request, Stay $stay)
    {
        $custom_name = $request->custom_name;
        $name = $request->name;
        $type = $request->type;
        $status = $request->status;
        $column = $request->column ?? 'id';
        $direction = $request->direction ?? 'desc';

        $valid_columns = ['custom_name', 'name', 'type', 'number_of_guests', 'charge_per_night', 'status', 'id'];
        $valid_directions = ['asc', 'desc'];

        if(!in_array($column, $valid_columns)) {
            $column = 'id';
        }

        if(!in_array($direction, $valid_directions)) {
            $direction = 'desc';
        }

        $items = $stay->rooms()->orderBy($column, $direction);

        if($custom_name) {
            $items->where('custom_name', 'like', '%' . $custom_name . '%');
        }

        if($name) {
            $items->where('name', $name);
        }

        if($type) {
            $items->where('type', $type);
        }

        if($status != null) {
            $items->where('status', $status);
        }

        $pagination = $request->pagination ?? 10;
        $items = $items->paginate($pagination);
        $items = $this->processData($items);

        if($request->ajax()) {
            $body_view = view('admin.stays.rooms._tbody', compact('items'))->render();
            $pagination_view = $items->appends($request->except('page'))->links("pagination::bootstrap-5")->render();

            return response()->json([
                'body_view' => $body_view,
                'pagination_view' => $pagination_view,
            ]);
        }

        return view('admin.stays.index', [
            'items' => $items,
            'pagination' => $pagination,
            'custom_name' => $custom_name,
            'name' => $name,
            'type' => $type,
            'status' => $status
        ]);
    }
}