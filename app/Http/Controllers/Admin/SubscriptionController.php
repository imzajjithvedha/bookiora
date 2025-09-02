<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private function processData($items)
    {
        foreach($items as $item) {
            $item->action = '
            <a id="'.$item->id.'" class="action-button delete-button" title="Delete"><i class="bi bi-trash3"></i></a>';
        }

        return $items;
    }

    public function index(Request $request)
    {
        $pagination = $request->pagination ?? 10;

        Subscription::where('is_new', 1)->update(['is_new' => 0]);

        $items = Subscription::orderBy('id', 'desc')->paginate($pagination);
        $items = $this->processData($items);

        return view('admin.subscriptions.index', [
            'items' => $items,
            'pagination' => $pagination
        ]);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->back()->with([
            'success' => 'Successfully deleted',
            'message' => 'This information is removed from the system.'
        ]);
    }

    public function filter(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $column = $request->column ?? 'id';
        $direction = $request->direction ?? 'desc';

        $valid_columns = ['name', 'email', 'id'];
        $valid_directions = ['asc', 'desc'];

        if(!in_array($column, $valid_columns)) {
            $column = 'id';
        }

        if(!in_array($direction, $valid_directions)) {
            $direction = 'desc';
        }

        $items = Subscription::orderBy($column, $direction);

        if($name) {
            $items->where('name', 'like', '%' . $name . '%');
        }

        if($email) {
            $items->where('email', 'like', '%' . $email . '%');
        }

        $pagination = $request->pagination ?? 10;
        $items = $items->paginate($pagination);
        $items = $this->processData($items);

        if($request->ajax()) {
            $body_view = view('admin.subscriptions.tbody', compact('items'))->render();
            $pagination_view = $items->appends($request->except('page'))->links("pagination::bootstrap-5")->render();

            return response()->json([
                'body_view' => $body_view,
                'pagination_view' => $pagination_view,
            ]);
        }

        return view('admin.subscriptions.index', [
            'items' => $items,
            'pagination' => $pagination,
            'name' => $name,
            'email' => $email
        ]);
    }
}