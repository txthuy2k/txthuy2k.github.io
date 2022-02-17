<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Slider::orderBy('slider_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id="'.$data->slider_id .'"  class="btn btn-outline-primary editsample"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->slider_id .'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Slider';
        return view('BackEnd.Slider.list', compact('title'));
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
            $slider = new Slider();
            $slider->slider_name = $request->slider_name;
            $slider->slider_desc = $request->slider_desc;
            $slider->slider_url = $request->slider_url;
            $slider->slider_status = $request->slider_status;

            if ($request->file('slider_image')) {
                $image = $request->file('slider_image');
                $name = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('uploads/slider'),$name);
                $slider->slider_image = $name;
            }

            $slider->save();

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
        $sample = Slider::findOrfail($id);
        if($sample){
            return response()->json([
                'status'=>200,
                'data'=>$sample
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
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
        $sample = Slider::findOrfail($id);
        if($sample){
            if($sample->slider_status == 1){
                $sample->slider_status = 2;
            }else{
                $sample->slider_status = 1;
            }
            $sample->save();
            return response()->json([
                'status'=>200
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
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
            $slider = Slider::findOrfail($id);
            if($slider){
                $slider->slider_name = $request->slider_name;
                $slider->slider_desc = $request->slider_desc;
                $slider->slider_url = $request->slider_url;
                $slider->slider_status = $request->slider_status;

                if ($request->file('slider_image')) {
                    $image = $request->file('slider_image');
                    $name = time().'_'.$image->getClientOriginalName();
                    $image->move(public_path('uploads/slider'),$name);
                    $slider->slider_image = $name;
                }

                $slider->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Add Successfully'
                ]);
            }else{
                return response()->json([
                    'status'=>404,
                    'message'=>'Data Not Found'
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
        $sample = Slider::findOrfail($id);
        if($sample){
            $sample->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Data Not Found'
            ]);
        }
    }
}
