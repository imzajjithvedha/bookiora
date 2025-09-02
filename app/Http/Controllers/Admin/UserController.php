<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private function processData($items)
    {
        foreach($items as $item) {
            $item->action = '
            <a href="'. route('admin.users.edit', $item->id) .'" class="action-button edit-button" title="Edit"><i class="bi bi-pencil-square"></i></a>
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
        $auth = Auth::user();

        User::where('is_new', 1)->update(['is_new' => 0]);

        $items = User::whereNot('id', $auth->id)->orderBy('id', 'desc')->paginate($pagination);
        $items = $this->processData($items);

        return view('admin.users.index', [
            'items' => $items,
            'pagination' => $pagination
        ]);
    }

    public function create()
    {
        return view('admin.users.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|min:3|max:50|unique:users,email',
            'display_name' => 'nullable|max:15',
            'phone' => 'nullable|min:8|max:15|regex:/^\+?[0-9]+$/|unique:users,phone',
            'dob' => 'nullable|date',
            'nationality' => 'nullable|max:50',
            'gender' => 'nullable|in:male,female,nondisclosure',
            'address' => 'nullable|max:100',
            'role' => 'required|in:admin,partner,explorer',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'new_image' => 'nullable|max:3072',
            'status' => 'required|in:0,1,2'
        ], [
            'new_image' => 'The image must not be greater than 3072 kilobytes.'
        ]);
        
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Creation failed',
                'message' => 'Your information has not been updated.'
            ]);
        }

        $image_name = null;
        if($request->file('new_image')) {
            $image = $request->file('new_image');
            $image_name = Str::random(40) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('backend/users', $image_name);
        }

        $data = $request->except('old_image', 'new_image', 'password_confirmation');
        $data['image'] = $image_name;
        $user = User::create($data);

        return redirect()->route('admin.users.index')->with([
            'success' => 'Update successful',
            'message' => 'All changes have been successfully updated and saved.'
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30',
            'email' => 'required|email|min:3|max:50|unique:users,email,'.$user->id,
            'display_name' => 'nullable|max:15',
            'phone' => 'nullable|min:8|max:15|regex:/^\+?[0-9]+$/|unique:users,phone,'.$user->id,
            'dob' => 'nullable|date',
            'nationality' => 'nullable|max:50',
            'gender' => 'nullable|in:male,female,nondisclosure',
            'address' => 'nullable|max:100',
            'role' => 'required|in:admin,partner,explorer',
            'new_image' => 'nullable|max:3072',
            'status' => 'required|in:0,1,2'
        ], [
            'new_image' => 'The image must not be greater than 3072 kilobytes.'
        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with([
                'error' => 'Update failed',
                'message' => 'Your information has not been updated.'
            ]);
        }

        $data = $request->except(
            'old_image',
            'new_image',
            'password',
            'password_confirmation'
        );

        if($request->password) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password',
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with([
                    'error' => 'Update failed',
                    'message' => 'Your information has not been updated.'
                ]);
            }

            $data['password'] = Hash::make($request->password);
        }

        if($request->file('new_image')) {
            if($request->old_image) {
                Storage::delete('backend/users/' . $request->old_image);
            }

            $image = $request->file('new_image');
            $image_name = Str::random(40) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('backend/users', $image_name);
        }
        else if($request->old_image == null) {
            if($user->image) {
                Storage::delete('backend/users/' . $user->image);
            }

            $image_name = null;
        }
        else {
            $image_name = $request->old_image;
        }

        $data['image'] = $image_name;
        $user->fill($data)->save();

        return redirect()->route('admin.users.index')->with([
            'success' => 'Update successful',
            'message' => 'All changes have been successfully updated and saved.'
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with([
            'success' => 'Successfully deleted',
            'message' => 'This information is removed from the system.'
        ]);
    }

    public function filter(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $role = $request->role;
        $status = $request->status;
        $column = $request->column ?? 'id';
        $direction = $request->direction ?? 'desc';

        $valid_columns = ['name', 'email', 'nationality', 'role', 'status', 'id'];
        $valid_directions = ['asc', 'desc'];

        if(!in_array($column, $valid_columns)) {
            $column = 'id';
        }

        if(!in_array($direction, $valid_directions)) {
            $direction = 'desc';
        }

        $items = User::whereNot('id', auth()->user()->id)->orderBy($column, $direction);

        if($name) {
            $items->where('name', 'like', '%' . $name . '%');
        }

        if($email) {
            $items->where('email', 'like', '%' . $email . '%');
        }

        if($role) {
            $items->where('role', $role);
        }

        if($status != null) {
            $items->where('status', $status);
        }

        $pagination = $request->pagination ?? 10;
        $items = $items->paginate($pagination);
        $items = $this->processData($items);

        if($request->ajax()) {
            $body_view = view('admin.users.tbody', compact('items'))->render();
            $pagination_view = $items->appends($request->except('page'))->links("pagination::bootstrap-5")->render();

            return response()->json([
                'body_view' => $body_view,
                'pagination_view' => $pagination_view,
            ]);
        }

        return view('admin.users.index', [
            'items' => $items,
            'pagination' => $pagination,
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'status' => $status
        ]);
    }
}