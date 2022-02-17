<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->page = 8;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title_name = 'Tất cả các sản phẩm';
        $check_cate = 'all';
        $all_product = Product::where('product_status',1)->orderBy('product_id','desc')->paginate($this->page);
        $category = Category::where('category_status',1)->limit(4)->get();
        return view('FrontEnd.all_product', compact('title_name','all_product','category','check_cate'));
    }

    public function search(){
        if(request()->ajax()){
            $data = request()->all();

            $query = $data['query'];

            $filter_data = Product::select('product_name')->where('product_name', 'LIKE', '%'.$query.'%')
                            ->get();

            $data = array();
            foreach ($filter_data as $fil)
            {
                $data[] = $fil->product_name;
            }

            return response()->json($data);
        }
        $data = request()->txtsearch;
        $check_search = $data;
        $check_cate = 'Search';
        $title_name = 'Search: "'.$data.'"';
        $all_product = Product::where('product_status',1)
                                ->where('product_name','LIKE','%'.$data.'%')
                                ->orwhere('product_desc','LIKE','%'.$data.'%')
                                ->orWhere('product_price','LIKE','%'.$data.'%')
                                ->orWhere('product_price_sale','LIKE','%'.$data.'%')
                                ->take($this->page)->paginate($this->page);

        return view('FrontEnd.all_product',compact('title_name','all_product','check_cate','check_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            if(request()->id_cate == 'all'){
                $check_cate = 'all';
                $check_search = '';
                $all_product = Product::where('product_status',1)->orderBy('product_id','desc')->paginate($this->page);
            }elseif(request()->id_cate == 'Search'){
                $data = request()->id_search;
                $check_search = $data;
                $check_cate = 'Search';
                $all_product = Product::where('product_status',1)
                                        ->where('product_name','LIKE','%'.$data.'%')
                                        ->orwhere('product_desc','LIKE','%'.$data.'%')
                                        ->orWhere('product_price','LIKE','%'.$data.'%')
                                        ->orWhere('product_price_sale','LIKE','%'.$data.'%')
                                        ->take($this->page)->paginate($this->page);
            }else{
                $check_cate = request()->id_cate;
                $check_search = '';
                $all_product = Product::where('product_status',1)
                                        ->where('category_id',$check_cate)
                                        ->orderBy('product_id','desc')
                                        ->paginate($this->page);
            }

            return view('FrontEnd.all_include',compact('all_product','check_cate','check_search'))->render();
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
        if(request()->ajax()){
            if($id == 'all'){
                $all_product = Product::where('product_status',1)
                                        ->orderBy('product_id','desc')
                                        ->paginate($this->page);
                $check_cate = $id;
            }else{
                $all_product = Product::where('product_status',1)
                                        ->where('category_id',$id)
                                        ->orderBy('product_id','desc')
                                        ->paginate($this->page);
                $check_cate = $id;
            }

            return view('FrontEnd.all_include',compact('all_product','check_cate'));
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
