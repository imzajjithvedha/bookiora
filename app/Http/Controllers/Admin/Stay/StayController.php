<?php

namespace App\Http\Controllers\Admin\Stay;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Stay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StayController extends Controller
{
    private function processData($items)
    {
        foreach($items as $item) {
            $item->action = '
            <a href="'. route('admin.stays.edit', $item->id) .'" class="action-button edit-button" title="Edit"><i class="bi bi-pencil-square"></i></a>
            <a href="'. route('admin.users.edit', $item->user_id) .'" class="action-button" title="User"><i class="bi bi-person-exclamation"></i></a>
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
        $users = User::where('status', 2)->where('role', 'partner')->get();

        return view('admin.stays.create', [
            'users' => $users
        ]);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'name' => 'required|min:3|max:100',
            'address' => 'required|min:3|max:200',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'apartment_floor_number' => 'nullable|min:3|max:50',
            'city' => 'required|min:3|max:255',
            'post_code' => 'required|digits_between:3,10',
            'country' => ['required', Rule::in(config('countries.list'))],

            'star_rating' => 'required|in:na,1,2,3,4,5',
            'facilities' => 'nullable|array',
            'facilities.*' => Rule::in(config('facilities.list')),
            'breakfast' => 'required|in:yes,no',
            'breakfast_pay' => 'nullable|in:yes,no',
            'breakfast_cost' => 'nullable|numeric|min:0',
            'breakfast_types' => 'nullable|array',
            'breakfast_types.*' => Rule::in(config('breakfasttypes.list')),
            'parking' => 'required|in:yes_free,yes_paid,no',
            'parking_reserve' => 'nullable|in:yes,no',
            'parking_location' => 'nullable|in:onsite,offsite',
            'parking_type' => 'nullable|in:private,public',
            'parking_cost' => 'nullable|numeric|min:0',
            'parking_cost_type' => 'nullable|in:per_hour,per_day,per_stay',

            'check_in_time_from' => ['required', Rule::in(config('times.list'))],
            'check_in_time_until' => ['required', Rule::in(config('times.list'))],
            'check_out_time_from' => ['required', Rule::in(config('times.list'))],
            'check_out_time_until' => ['required', Rule::in(config('times.list'))],

            'allow_children' => 'required|in:yes,no',
            'allow_pets' => 'required|in:yes,no',
            'allow_pets_charges' => 'nullable|in:yes,no',
            
            'new_thumbnail' => 'required|max:3072',

            'new_images' => 'nullable|array',
            'new_images.*' => 'max:3072',
            'status' => 'required|in:0,1,2'
        ], [
            'address.required' => 'Address field is required.',
            'latitude.required' => 'Address field is required.',
            'longitude.required' => 'Address field is required.',
            'new_thumbnail.required' => 'The thumbnail is required.',
            'new_thumbnail.max' => 'The thumbnail must not be greater than 3072 kilobytes.',
            'new_images.*.max' => 'The image must not be greater than 3072 kilobytes.',

            'facilities.*.in' => 'One or more selected facilities are invalid.',
            'breakfast_types.*.in' => 'One or more selected breakfast types are invalid.',
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
        $data['thumbnail'] = $thumbnail_name;
        $data['images'] = $new_images ? json_encode($new_images) : null;
        $data['breakfast_types'] = $request->breakfast_types ? json_encode($request->breakfast_types) : null;
        $data['facilities'] = $request->facilities ? json_encode($request->facilities) : null;

        $stay = Stay::create($data);  

        return redirect()->route('admin.stays.index')->with([
            'success' => 'Create successful',
            'message' => 'All changes have been successfully updated and saved.'
        ]);
    }

    public function edit(Stay $stay)
    {
        $users = User::where('status', 2)->where('role', 'partner')->get();

        return view('admin.stays.edit', [
            'stay' => $stay,
            'users' => $users
        ]);
    }

    public function update(Request $request, Stay $stay)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'name' => 'required|min:3|max:100',
            'address' => 'required|min:3|max:200',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'apartment_floor_number' => 'nullable|min:3|max:50',
            'city' => 'required|min:3|max:255',
            'post_code' => 'required|digits_between:3,10',
            'country' => ['required', Rule::in(config('countries.list'))],

            'star_rating' => 'required|in:na,1,2,3,4,5',
            'facilities' => 'nullable|array',
            'facilities.*' => Rule::in(config('facilities.list')),
            'breakfast' => 'required|in:yes,no',
            'breakfast_pay' => 'nullable|in:yes,no',
            'breakfast_cost' => 'nullable|numeric|min:0',
            'breakfast_types' => 'nullable|array',
            'breakfast_types.*' => Rule::in(config('breakfasttypes.list')),
            'parking' => 'required|in:yes_free,yes_paid,no',
            'parking_reserve' => 'nullable|in:yes,no',
            'parking_location' => 'nullable|in:onsite,offsite',
            'parking_type' => 'nullable|in:private,public',
            'parking_cost' => 'nullable|numeric|min:0',
            'parking_cost_type' => 'nullable|in:per_hour,per_day,per_stay',

            'check_in_time_from' => ['required', Rule::in(config('times.list'))],
            'check_in_time_until' => ['required', Rule::in(config('times.list'))],
            'check_out_time_from' => ['required', Rule::in(config('times.list'))],
            'check_out_time_until' => ['required', Rule::in(config('times.list'))],

            'allow_children' => 'required|in:yes,no',
            'allow_pets' => 'required|in:yes,no',
            'allow_pets_charges' => 'nullable|in:yes,no',
            
            'thumbnail' => 'nullable|max:3072',

            'new_images' => 'nullable|array',
            'new_images.*' => 'max:3072',
            'status' => 'required|in:0,1,2'
        ], [
            'address.required' => 'Address field is required.',
            'latitude.required' => 'Address field is required.',
            'longitude.required' => 'Address field is required.',
            'new_thumbnail.max' => 'The thumbnail must not be greater than 3072 kilobytes.',
            'new_images.*.max' => 'The image must not be greater than 3072 kilobytes.',

            'facilities.*.in' => 'One or more selected facilities are invalid.',
            'breakfast_types.*.in' => 'One or more selected breakfast types are invalid.',
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
            $existing_images = json_decode($stay->images ?? '[]', true);
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
        $data['breakfast_types'] = $request->breakfast_types ? json_encode($request->breakfast_types) : null;
        $data['facilities'] = $request->facilities ? json_encode($request->facilities) : null;
        $stay->fill($data)->save();
        
        return redirect()->route('admin.stays.index')->with([
            'success' => 'Update successful',
            'message' => 'All changes have been successfully updated and saved.'
        ]);
    }

    public function destroy(Stay $stay)
    {
        $stay->delete();

        return redirect()->back()->with([
            'success' => 'Successfully deleted',
            'message' => 'This information is removed from the system.'
        ]);
    }

    public function filter(Request $request)
    {
        $name = $request->name;
        $address = $request->address;
        $city = $request->city;
        $status = $request->status;
        $column = $request->column ?? 'id';
        $direction = $request->direction ?? 'desc';

        $valid_columns = ['name', 'address', 'city', 'post_code', 'Country', 'status', 'id'];
        $valid_directions = ['asc', 'desc'];

        if(!in_array($column, $valid_columns)) {
            $column = 'id';
        }

        if(!in_array($direction, $valid_directions)) {
            $direction = 'desc';
        }

        $items = Stay::orderBy($column, $direction);

        if($name) {
            $items->where('name', 'like', '%' . $name . '%');
        }

        if($address) {
            $items->where('address', 'like', '%' . $address . '%');
        }

        if($city) {
            $items->where('city', 'like', '%' . $city . '%');
        }

        if($status != null) {
            $items->where('status', $status);
        }

        $pagination = $request->pagination ?? 10;
        $items = $items->paginate($pagination);
        $items = $this->processData($items);

        if($request->ajax()) {
            $body_view = view('admin.stays._tbody', compact('items'))->render();
            $pagination_view = $items->appends($request->except('page'))->links("pagination::bootstrap-5")->render();

            return response()->json([
                'body_view' => $body_view,
                'pagination_view' => $pagination_view,
            ]);
        }

        return view('admin.stays.index', [
            'items' => $items,
            'pagination' => $pagination,
            'name' => $name,
            'address' => $address,
            'city' => $city,
            'status' => $status
        ]);
    }
}