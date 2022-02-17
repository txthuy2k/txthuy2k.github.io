<?php

namespace App\Http\Controllers\BackEnd;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Category::orderBy('category_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id="'.$data->category_id.'"  class="btn btn-outline-primary editsample"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->category_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Category';
        return view('BackEnd.Category.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(request()->ajax()){
            $category = new Category();
            $category->category_name = $request->cate_name;
            $category->category_slug  = $request->cate_slug;
            $category->category_status = $request->cate_status;

            if ($request->file('category_image')) {
                $image = $request->file('category_image');
                $name = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads/category'),$name);
                $category->category_image = $name;
            }

            $category->save();

            return response()->json([
                'status'=>200,
                'message'=>'Add Successfully'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sample = Category::findOrfail($id);
        if($sample){
            return response()->json([
                'status'=>200,
                'data'=>$sample
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Category Not Found'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sample = Category::findOrfail($id);
        if($sample){
            if($sample->category_status == 1){
                $sample->category_status = 2;
            }else{
                $sample->category_status = 1;
            }
            $sample->save();
            return response()->json([
                'status'=>200
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Category Not Found'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(request()->ajax()){
            $category = Category::findOrfail($id);
            if($category){
                $category->category_name = $request->cate_name;
                $category->category_slug  = $request->cate_slug;
                $category->category_status = $request->cate_status;

                if ($request->file('category_image')) {
                    unlink(public_path('uploads/category/').$category->category_image);
                    $image = $request->file('category_image');
                    $name = time().'_'.$image->getClientOriginalName();
                    $image->move(public_path('uploads/category'),$name);
                    $category->category_image = $name;
                }
                $category->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Add Successfully'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Category Not Found'
                ]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sample = Category::findOrfail($id);
        if($sample){
            unlink(public_path('uploads/category/').$sample->category_image);
            $sample->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Category Not Found'
            ]);
        }
    }
}
