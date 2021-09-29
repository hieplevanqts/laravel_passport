<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        // return Category::fixTree();
        $categories = Category::withDepth()->defaultOrder()->get()->toFlatTree();
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
}
