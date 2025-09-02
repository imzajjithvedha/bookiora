<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
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

        Support::where('is_new', 1)->update(['is_new' => 0]);

        $items = Support::orderBy('id', 'desc')->paginate($pagination);
        $items = $this->processData($items);

        return view('admin.supports.index', [
            'items' => $items,
            'pagination' => $pagination
        ]);
    }

    public function destroy(Support $support)
    {
        $support->delete();

        return redirect()->back()->with([
            'success' => 'Successfully deleted',
            'message' => 'This information is removed from the system.'
        ]);
    }

    public function filter(Request $request)
    {
        $name = $request->name;
        $column = $request->column ?? 'id';
        $direction = $request->direction ?? 'desc';

        $valid_columns = ['name', 'phone', 'email', 'category', 'subject', 'message', 'id'];
        $valid_directions = ['asc', 'desc'];

        if(!in_array($column, $valid_columns)) {
            $column = 'id';
        }

        if(!in_array($direction, $valid_directions)) {
            $direction = 'desc';
        }

        $items = Support::orderBy($column, $direction);

        if($name) {
            $items->where('name', 'like', '%' . $name . '%');
        }

        $pagination = $request->pagination ?? 10;
        $items = $items->paginate($pagination);
        $items = $this->processData($items);

        if($request->ajax()) {
            $body_view = view('admin.supports.tbody', compact('items'))->render();
            $pagination_view = $items->appends($request->except('page'))->links("pagination::bootstrap-5")->render();

            return response()->json([
                'body_view' => $body_view,
                'pagination_view' => $pagination_view,
            ]);
        }

        return view('admin.supports.index', [
            'items' => $items,
            'pagination' => $pagination,
            'name' => $name
        ]);
    }
}