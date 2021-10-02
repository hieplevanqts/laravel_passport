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
        $categories = Category::withDepth()->defaultOrder()->having('depth', '>', 0)->get()->toFlatTree();
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

    public function dataTable(Request $request)
    {
        $data = [];
        $draw = $request->draw ? $request->draw : 10;
        $row =  $_POST['start'] ? $_POST['start'] : 0;
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        // $searchValue = mysqli_real_escape_string($con,$_POST['search']['value']); 
        $str = $_POST['search']['value'];
        if( $str){
            if($columnName && $columnSortOrder){
                $all = Category::limit($rowperpage)
                                ->offset($row)
                                ->where('name', 'like', "%$str%")
                                ->orderBy($columnName, $columnSortOrder)
                                ->get();
                $totalRecords = count(Category::where('name', 'like', "%$str%")
                ->orderBy($columnName, $columnSortOrder)
                ->get());
                $totalRecordwithFilter = count(Category::where('name', 'like', "%$str%")
                ->orderBy($columnName, $columnSortOrder)
                ->get());
            }else{
                $all = Category::limit($rowperpage)->offset($row)->where('name', 'like', "%$str%")->get();
                $totalRecords = count(Category::where('name', 'like', "%$str%")->get());
                $totalRecordwithFilter = count(Category::where('name', 'like', "%$str%")->get());
            }
        }else{
            if($columnName && $columnSortOrder){
                $all = Category::orderBy($columnName, $columnSortOrder)
                ->limit($rowperpage)
                ->offset($row)->get();
                $totalRecords = count(Category::orderBy($columnName, $columnSortOrder)->get());
                $totalRecordwithFilter = count(Category::orderBy($columnName, $columnSortOrder)->get());
            }else{
                $all = Category::limit($rowperpage)
                ->offset($row)->get();
                $totalRecords = count(Category::all());
                $totalRecordwithFilter = count(Category::all());
            }
            
        }
        foreach ($all as $key => $value) {
            $data[$key] = [
                'id' => $value->id,
                'name' => $value->name,
                'order' => ''
            ];
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        return response()->json($response);
    }
}
