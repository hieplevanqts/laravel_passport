<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Log;

class CategoryController extends Controller
{

    public function index()
    {
        // return Category::fixTree();
        $categories = Category::withDepth()->defaultOrder()->having('depth', '>', 0)->get()->toTree();
        // dd($categories);
        return view('categories.index', compact('categories'));
    }

    public function move(Request $request)
    {
        $id = $request->id;
        $type = $request->type;
        $node = Category::find($id);
        if($type == 'up')
        {
            $node->up();
        }else{
            $node->down();
        }

        return redirect()->back();
    }

    public function updateTree(Request $request)
    {
        $data = $request->data;
        $root = Category::find(1);
        Category::rebuildSubtree($root, $data);
        return response()->json($data);
    }
}
