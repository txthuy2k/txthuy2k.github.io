<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Category;
use App\Slider;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $our_product = Product::where('product_status',1)->limit(8)->get();
        $slider = Slider::where('slider_status',1)->orderBy('slider_id','desc')->get();
        $category_left = Category::orderByRaw("RAND()")->where('category_status',1)->take(2)->get();
        $category_right = Category::orderByRaw("RAND()")->where('category_status',1)->skip(2)->take(2)->get();
        $deal_product = Product::where('product_status',1)->where('product_price_sale','<>',0)->inRandomOrder()->first();

        return view('FrontEnd.index', compact('our_product','slider','category_left','category_right','deal_product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            $output = '';
            $count = Cart::where('user_id',Auth::id())->where('cart_status',1)->get()->count();
            if(Auth::check()){
                $output .=''.$count.'';
            }else{
                $output .='0';
            }

            return response()->json($output);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
