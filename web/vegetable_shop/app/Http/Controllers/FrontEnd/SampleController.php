<?php

namespace App\Http\Controllers\FrontEnd;

use App\Cart;
use App\Order;
use App\Coupon;
use App\Customer;
use Carbon\Carbon;
use App\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SampleController extends Controller
{
    public function index_contact(){
        $title_name = 'Liên hệ với chúng tôi';
        return view('FrontEnd.contact', compact('title_name'));
    }
    public function store_contact(Request $request){
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDayDateTimeString();
        Mail::send('FrontEnd.SendMail.contact',
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'content'=>$request->mess
            ],function ($message) use($request,$now) {
                $message->to('txthuy2k@gmail.com', 'Thủy Bùi');
                $message->from($request->email, 'Thủy Bùi - Liên hệ');
                $message->subject($request->subject.' '.$now);
            });

        return response()->json([
            'message'=>'Chúng tôi sẽ sớm phản hồi.'
        ]);
    }

    public function index_about(){
        $title_name = 'Giới thiệu';
        return view('FrontEnd.about', compact('title_name'));
    }
    public function Logout(){
        Auth::logout();
        return redirect()->route('home.index');
    }
    // public function store_coupon(Request $request){
    //     if($request->ajax()){
    //         $data = $request->all();
    //         $today_d =  Carbon::now('Asia/Ho_Chi_Minh')->format('d');
    //         $today_m =  Carbon::now('Asia/Ho_Chi_Minh')->format('m');
    //         $today_y =  Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
    //         if (Auth::user()) {
    //             $date_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
    //             if ($date_coupon) {
    //                 $create = date_create($date_coupon->coupon_date_end);
    //                 $day = date_format($create,'d');
    //                 $month = date_format($create,'m');
    //                 $year = date_format($create,'Y');

    //                 if ($month > $today_m && $year >= $today_y) {
    //                     $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->where('coupon_used', 'LIKE', '%'.Auth::id().'%')->first();
    //                 }else if($month == $today_m && $year == $today_y){
    //                     if ($day >= $today_d) {
    //                         $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->where('coupon_used', 'LIKE', '%'.Auth::id().'%')->first();
    //                     }else{
    //                         return response()->json(['error'=>'The discount code is incorrect or has expired']);
    //                     }
    //                 }else{
    //                     return response()->json(['error'=>'The discount code is incorrect or has expired']);
    //                 }



    //             }else{
    //                 return response()->json(['error'=>'The discount code is incorrect or has expired']);
    //             }
    //         }else{
    //             return response()->json([
    //                 'url'=>route('login.index'),
    //                 'error_login'=>'Please login to use discount code!'
    //             ]);
    //         }

    //         if ($used_coupon) {
    //             return response()->json(['error'=>'Discount code already used, please enter another code']);
    //         }else{
    //             $date_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
    //             $create_date = date_create($date_coupon->coupon_date_end);
    //             $day = date_format($create_date,'d');
    //             $month = date_format($create_date,'m');
    //             $year = date_format($create_date,'Y');
    //             if ($month > $today_m && $year >= $today_y) {
    //                 $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
    //             }else if($month == $today_m && $year == $today_y){
    //                 if ($day >= $today_d) {
    //                     $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
    //                 }else{
    //                     return response()->json(['error'=>'The discount code is incorrect or has expired']);
    //                 }
    //             }else{
    //                 return response()->json(['error'=>'The discount code is incorrect or has expired']);
    //             }

    //             if ($coupon) {
    //                 $coupon_count = $coupon->count();
    //                 if ($coupon_count>0) {
    //                     $coupon_session = Session::get('coupon');
    //                     if ($coupon_session==true) {
    //                         $is_avaiable = 0;
    //                         if ($is_avaiable==0) {
    //                             $coun[] = array(
    //                                 'coupon_code' => $coupon->coupon_code,
    //                                 'coupon_condition' => $coupon->coupon_condition,
    //                                 'coupon_number' => $coupon->coupon_sale_number,
    //                             );
    //                             Session::put('coupon',$coun);
    //                         }
    //                     }else{
    //                         $coun[] = array(
    //                                 'coupon_code' => $coupon->coupon_code,
    //                                 'coupon_condition' => $coupon->coupon_condition,
    //                                 'coupon_number' => $coupon->coupon_sale_number,
    //                             );
    //                         Session::put('coupon',$coun);
    //                     }
    //                     Session::save();

    //                     return response()->json(['message'=>'Add Coupon Successfully']);

    //                 }
    //             }else{
    //                 return response()->json(['error'=>'The discount code is incorrect or has expired']);
    //             }
    //         }

    //     }
    // }
    public function save_cart(Request $request){
        $checkout_code = mt_rand();
        $carts= Cart::join('product','product.product_id','cart.pro_id')
                        ->where('user_id',Auth::id())
                        ->where('cart_status',1)
                        ->get();

        $customer = new Customer();
        $customer->customer_name = $request->name;
        $customer->customer_email = $request->email;
        $customer->customer_address = $request->address;
        $customer->customer_phone = $request->phone;
        $customer->customer_note = $request->note;
        $customer->customer_pay = $request->pay_radio;
        $customer->save();

        $order = new Order;
        $order->cus_id  = $customer->customer_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->save();

        if(count($carts) > 0){
            foreach($carts as $cart){
                if($cart->product_price_sale != 0){
                    $price = $cart->product_price_sale;
                }else{
                    $price = $cart->product_price;
                }
                $order_details = new OrderDetail;
                $order_details->order_code = $checkout_code;
                $order_details->pro_id  = $cart->pro_id;
                $order_details->order_de_price = $price;
                $order_details->order_de_qty = $cart->cart_qty;
                if (Session::get('coupon')) {
                    foreach (Session::get('coupon') as $cou) {
                        $order_details->order_de_coupon =  $cou['coupon_code'];
                    }
                }else{
                    $order_details->order_de_coupon =  'no';
                }
                $order_details->save();

                $status = Cart::where('cart_id',$cart->cart_id)->first();
                $status->cart_status = 2;
                $status->save();
            }
        }
        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $coun){
                $coupon_qty = Coupon::where('coupon_code',$coun['coupon_code'])->first();
                $coupon_qty->coupon_used = ','.Auth::id();
                $coupon_qty->coupon_qty--;
                $coupon_qty->save();
            }
        }
        Session::forget('coupon');

        return response()->json([
            'status'=>200,
            'message'=>'Order Successfully!'
        ]);
    }


}
