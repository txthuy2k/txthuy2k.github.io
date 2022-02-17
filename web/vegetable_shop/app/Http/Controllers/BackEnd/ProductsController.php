<?php

namespace App\Http\Controllers\BackEnd;

// use Image;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Product::join('category','category.category_id','product.category_id')->orderBy('product_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-id_product="'.$data->product_id.'"  class="btn btn-outline-primary editpro"><i class="fa fa-edit"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" class="btn btn-outline-danger delete" data-id_product="'.$data->product_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    return $button;
                })
                ->addColumn('price_td', function($data){
                    if ($data->product_price_sale > 0) {
                        $price = '<span class="text-success">'.number_format($data->product_price_sale).'</span>';
                    }else{
                        $price = '<span>'.number_format($data->product_price).'</span>';
                    }
                    return $price;
                })
                ->addColumn('image', function($data){
                    return '<img src="'.url('uploads/product/'.$data->product_image).'" width="80px" height="80px" class="img-thumbnail" />';
                })
                ->rawColumns(['action','price_td','image'])
                ->make(true);
        }
        $title = 'Product';
        $category = Category::all();
        return view('BackEnd.Product.list', compact('title','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){
            $data = Str::slug(request()->keyword);
            return response()->json($data);
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
        if(request()->ajax()){
            $product = new Product();
            $product->product_name = $request->pro_name;
            $product->product_slug  = $request->pro_slug;
            $product->product_price = Str::slug($request->pro_price);
            $product->product_price_sale = Str::slug($request->pro_price_sale);
            $product->product_quantity = $request->pro_qty;
            $product->product_status = $request->pro_status;
            $product->product_desc = $request->pro_desc;
            $product->category_id = $request->pro_cate;
            $product->product_view = 0;
            $product->product_sold = 0;

            if ($request->file('pro_image')) {
                $image = $request->file('pro_image');
                $name = time().'_'.$image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(253, 203);
                $image_resize->save(public_path('uploads/product/' .$name));
                $product->product_image = $name;
            }

            $product->save();

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
        $product = Product::findOrfail($id);
        if($product){
            return response()->json([
                'status'=>200,
                'data'=>$product
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Product Not Found'
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
        $product = Product::findOrfail($id);
        if($product){
            if($product->product_status == 1){
                $product->product_status = 2;
            }else{
                $product->product_status = 1;
            }
            $product->save();
            return response()->json([
                'status'=>200
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Product Not Found'
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
            $product =Product::find($id);
            $product->product_name = $request->pro_name;
            $product->product_slug  = $request->pro_slug;
            $product->product_price = Str::slug($request->pro_price);
            $product->product_price_sale = Str::slug($request->pro_price_sale);
            $product->product_quantity = $request->pro_qty;
            $product->product_status = $request->pro_status;
            $product->product_desc = $request->pro_desc;
            $product->category_id = $request->pro_cate;
            $product->product_view = 0;
            $product->product_sold = 0;

            if ($request->file('pro_image')) {
                unlink(public_path('uploads/product/').$product->product_image);
                $image = $request->file('pro_image');
                $name = time().'_'.$image->getClientOriginalName();

                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(253, 203);
                $image_resize->save(public_path('uploads/product/' .$name));

                // $image->move(public_path('uploads/product'),$name);
                $product->product_image = $name;
            }

            $product->save();

            return response()->json([
                'status'=>200,
                'message'=>'Update Successfully'
            ]);
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
        $product = Product::findOrfail($id);
        if($product){
            unlink(public_path('uploads/product/').$product->product_image);
            $product->delete();

            return response()->json([
                'status'=>200,
                'message'=>'Delete Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Product Not Found'
            ]);
        }
    }
}
