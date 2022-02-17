<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
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
            $output_2 = '';
            $total = 0;
            $subtotal = 0;
            $carts= Cart::join('product','product.product_id','cart.pro_id')
                        ->where('user_id',Auth::id())
                        ->where('cart_status',1)
                        ->get();
            $count = Cart::where('user_id',Auth::id())->where('cart_status',1)->get()->count();
            foreach($carts as $cart){
                if($cart->product_price_sale != 0){
                    $price = $cart->product_price_sale;
                }else{
                    $price = $cart->product_price;
                }
                $subtotal += ($cart->cart_qty)*($price);
                $output .='
                <tr class="text-center">
                    <td class="product-remove"><a href="#" data-id="'.$cart->cart_id.'" class="removecart"><span class="ion-ios-close"></span></a></td>

                    <td class="image-prod">
                        <a href="'.route('detail.show',$cart->product_slug).'"><div class="img" style="background-image: url('. asset('uploads/product/'.$cart->product_image) .');"></div></a>
                    </td>

                    <td class="product-name">
                        <a href="'.route('detail.show',$cart->product_slug).'"><h3>'.$cart->product_name.'</h3></a>
                        <p>'.substr($cart->product_desc, 0, 50).'...</p>
                    </td>';
                    if($cart->product_price_sale != 0){
                        $output .='<td class="price">'.number_format($cart->product_price_sale).' vnđ</td>';
                    }else{
                        $output .='<td class="price">'.number_format($cart->product_price).' vnđ</td>';
                    }
                    $output .='
                    <td class="quantity" style="width: 0% !important;">
                        <div class="input-group mb-3">
                            <input type="number" data-id="'.$cart->cart_id.'" name="quantity" class="quantity form-control input-number up_qty" value="'.$cart->cart_qty.'" min="1" max="100" oninput="this.value = Math.abs(this.value)">
                        </div>
                    </td>
                    <td class="total">'.number_format(($cart->cart_qty)*($price)).' vnđ</td>
                </tr>
                ';
            }
            if($count <= 0){
                Session::forget('coupon');
                $total = 0;
            }
            if(Session::get('coupon')){
                foreach(Session::get('coupon') as $coupon){
                    if($coupon['coupon_condition'] == 2){
                        $show_number = $coupon['coupon_number'].'%';
                        $subcoupon = $subtotal*$coupon['coupon_number']/100;
                        $total += $subtotal - $subcoupon;
                    }else{
                        $show_number = number_format($coupon['coupon_number']).' '.'vnđ';
                        $total += $subtotal - $coupon['coupon_number'];
                    }
                }
            }else{
                $show_number = '0 vnđ';
                $total += $subtotal;
            }
            Session::put('total',$total);
            $output_2 .= '
                <h3>Thanh toán giỏ hàng</h3>
                <p class="d-flex">
                    <span>Tổng tiền sản phẩm</span>
                    <span>'.number_format($subtotal).' vnđ</span>
                </p>
                <p class="d-flex">
                    <span>Phí vận chuyển</span>
                    <span>0 vnđ</span>
                </p>
                <p class="d-flex">
                    <span>Giảm giá</span>
                    <span>'.$show_number.'</span>
                </p>
                <hr>
                <p class="d-flex total-price">
                    <span>Tổng thanh toán</span>
                    <span>'.number_format($total).' vnđ</span>
                </p>
            ';
            return response()->json([
                'cart'=>$output,
                'total'=>$output_2
            ]);
        }
        $title_name = 'Giỏ hàng của tôi';
        $countcart = Cart::where('user_id',Auth::id())->get()->count();
        return view('FrontEnd.Cart.cart', compact('title_name','countcart'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(request()->ajax()){

        }
        $title_name = 'Thanh toán';
        $count = Cart::where('user_id',Auth::id())->where('cart_status',1)->get()->count();
        return view('FrontEnd.Cart.checkout', compact('title_name','count'));
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
                $check_cart = Cart::where('user_id',Auth::id())->where('pro_id',$request->id)->where('cart_status',1)->first();
                if ($check_cart) {
                    $check_cart->cart_qty = $check_cart->cart_qty+$request->qty;
                    $check_cart->save();

                    return response()->json([
                        'action'=>'update',
                        'message'=>'Update Cart Successfully!'
                    ]);
                }else{
                    $cart = new Cart();
                    $cart->user_id = Auth::id();
                    $cart->pro_id = $request->id;
                    $cart->cart_qty = $request->qty;
                    $cart->cart_status = 1;
                    $cart->save();

                    return response()->json([
                        'action'=>'add',
                        'message'=>'Add Cart Successfully!'
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
        if(request()->ajax()){
            $cart = Cart::findOrfail($id);
            if($cart){
                $cart->cart_qty = $request->qty;
                $cart->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Update Successfully!'
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
        if(request()->ajax()){
            $cart = Cart::findOrfail($id);
            if($cart){
                $cart->delete();

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
