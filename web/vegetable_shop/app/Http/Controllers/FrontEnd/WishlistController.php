<?php

namespace App\Http\Controllers\FrontEnd;

use App\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            $output = '';
            $wishlist = Wishlist::join('product','product.product_id','wishlist.pro_id')->where('user_id',Auth::id())->get();
            foreach($wishlist as $wish){
                $output .='
                <tr class="text-center">
                    <td class="product-remove"><a href="#" data-id="'.$wish->wishlist_id.'" class="removewish"><span class="ion-ios-close"></span></a></td>

                    <td class="image-prod">
                        <a href="'.route('detail.show',$wish->product_slug).'"><div class="img" style="background-image: url('. asset('uploads/product/'.$wish->product_image) .');"></div></a>
                    </td>

                    <td class="product-name">
                        <a href="'.route('detail.show',$wish->product_slug).'"><h3>'.$wish->product_name.'</h3></a>
                        <p>'.substr($wish->product_desc, 0, 50).'...</p>
                    </td>';
                    if($wish->product_price_sale != 0){
                        $output .='<td class="price">'.number_format($wish->product_price_sale).' vnđ</td>';
                    }else{
                        $output .='<td class="price">'.number_format($wish->product_price).' vnđ</td>';
                    }
                    $output .='
                    <td class="quantity" style="width: 0% !important;">
                        <div class="input-group mb-3">
                            <input type="number" name="quantity" class="quantity form-control input-number quantity'. $wish->product_id .'" value="1" min="1" max="100" oninput="this.value = Math.abs(this.value)">
                        </div>
                    </td>

                    <td class="total"><a href="#" data-id="'.$wish->product_id.'" class="btn btn-black py-2 px-3 addcart">Thêm vào giỏ hàng</a></td>
                </tr>
                ';
            }

            return response()->json($output);
        }
        $title_name = 'Yêu thích';
        return view('FrontEnd.wishlist', compact('title_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            if(Auth::check()){
                $check_wish = Wishlist::where('user_id',Auth::id())->where('pro_id',$request->id)->first();
                if ($check_wish) {
                    $check_wish->delete();

                    return response()->json([
                        'action'=>'remove'
                    ]);
                }else{
                    $wish = new Wishlist();
                    $wish->user_id = Auth::id();
                    $wish->pro_id = $request->id;
                    $wish->save();

                    return response()->json([
                        'action'=>'add',
                        'message'=>'Successfully!'
                    ]);
                }
            }else{
                return response()->json([
                    'action'=>'login',
                    'url'=>route('sign.index')
                ]);
            }
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
        if(request()->ajax()){
            $wish = Wishlist::findOrfail($id);
            if($wish){
                $wish->delete();

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
    }
}
