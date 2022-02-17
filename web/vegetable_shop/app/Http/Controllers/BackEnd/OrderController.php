<?php

namespace App\Http\Controllers\BackEnd;

use App\Order;
use App\Coupon;
use App\Product;
use App\Customer;
use Carbon\Carbon;
use App\OrderDetail;
use App\Statistical;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return datatables()->of(Order::join('customer','customer.customer_id','order.cus_id')->orderBy('order_id','desc')->get())
                ->addColumn('action', function($data){
                    $button = '<button type="button" data-action="'.route('order.show',$data->order_code).'" data-id="'.$data->order_code.'"  class="btn btn-outline-primary editsample"><i class="fas fa-info-circle"></i></button>';
                    $button .= '&nbsp;&nbsp;';
                    if($data->order_status == 1){
                        $button .= '<button type="button" class="btn btn-outline-danger delete" data-id="'.$data->order_id.'"><i class="fa fa-trash"></i>
                            </button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $title = 'Order';
        return view('BackEnd.Order.list', compact('title'));
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
            $output = '';
            $output_2 = '';
            $subtotal = 0;
            $total = 0;
            $detail = OrderDetail::join('product','product.product_id','order_detail.pro_id')->where('order_code',$id)->get();
            $order = Order::where('order_code',$id)->first();
            $customer = Customer::where('customer_id',$order->cus_id)->first();
            if($detail){
                foreach($detail as $row){

                    $subtotal += $row->order_de_price*$row->order_de_qty;
                    if($row->order_de_coupon == 'no'){
                        $totalCoupon = 0;
                        $total = $subtotal;
                    }else{
                        $coupon = Coupon::where('coupon_code',$row->order_de_coupon)->first();
                        if($coupon->coupon_condition == 2){
                            $totalCoupon = $coupon->coupon_sale_number.'%';
                            $total = $subtotal-($subtotal*$coupon->coupon_sale_number/100);
                        }else{
                            $totalCoupon = number_format($coupon->coupon_sale_number);
                            $total = $subtotal-$coupon->coupon_sale_number;
                        }
                    }
                    $output .='
                        <tr>
                            <th scope="row">' .$row->product_name. '<input type="hidden" name="order_product_id" class="order_product_id" value="'.$row->product_id.'"></th>';
                            if($order->order_status != 1){
                                $output .='<td class="update_qty idpro_'.$row->order_detail_id .'" data-id="'.$row->order_detail_id .'">' .$row->order_de_qty. '<input type="hidden" name="product_quantity_order" value="'.$row->order_de_qty.'"></td>';
                            }else{
                                $output .='<td contenteditable class="update_qty idpro_'.$row->order_detail_id .'" data-id="'.$row->order_detail_id .'">' .$row->order_de_qty. '<input type="hidden" name="product_quantity_order" value="'.$row->order_de_qty.'"></td>';
                            }
                            $output .='
                            <td>' .$row->product_quantity. '</td>
                            <td>' .$row->order_de_coupon. '</td>
                            <td>' .number_format($row->order_de_price). '</td>
                        </tr>
                    ';
                }
                $output_2 = '
                    <tr>
                        <td colspan="3" style="text-align: center;">SubTotal</td>
                        <td>'.$totalCoupon.'</td>
                        <td class="subtotal">'.number_format($subtotal).'</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;"><b>Total</b></td>
                        <td colspan="2" style="text-align: center;"><b class="total">'.number_format($total).' vnđ</b></td>
                    </tr>
                ';

                return response()->json([
                    'status'=>200,
                    'data'=>$output,
                    'data_2'=>$output_2,
                    'or'=>$order,
                    'cus'=>$customer
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $order = Order::where('order_code',$id)->first();
        if ($order) {
            $order->order_status = $request->value;
            $order->save();

            //order date
            $data = $request->all();
            $order_date  = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $statistic = Statistical::where('order_date',$order_date)->get();
            if($statistic){
                $statistic_count = $statistic->count();
            }else{
                $statistic_count = 0;
            }

            //Add
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;

            if ($order->order_status == 2) {

                foreach ($data['order_product_id'] as $key => $product_id) {
                    $product = Product::find($product_id);
                    $product_qty = $product->product_quantity;
                    $product_sold = $product->product_sold;

                    $product_price = $product->product_price;
                    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                    foreach ($data['quantity'] as $key2 => $qty) {
                        if ($key==$key2) {
                            $pro_remain = $product_qty - $qty;
                            $product->product_quantity = $pro_remain;
                            $product->product_sold = $product_sold + $qty;
                            $product->save();
                        }
                    }
                }

            }else if($order->order_status == 3){
                foreach ($data['order_product_id'] as $key => $product_id) {
                    $product = Product::find($product_id);

                    $product_price = $product->product_price;
                    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                    foreach ($data['quantity'] as $key2 => $qty) {
                        if ($key==$key2) {
                            //update doanh thu
                            $quantity       += $qty;
                            $total_order    += 1;
                            $sales          += $product_price*$qty;
                            $profit         =  $sales - 1000;
                        }
                    }
                }
                //update doanh so db
                if($statistic_count > 0){
                    $statistic_update = Statistical::where('order_date',$order_date)->first();
                    $statistic_update->sales = $statistic_update->sales + $sales;
                    $statistic_update->profit =  $statistic_update->profit + $profit;
                    $statistic_update->quantity =  $statistic_update->quantity + $quantity;
                    $statistic_update->total_order = $statistic_update->total_order + $total_order;
                    $statistic_update->save();

                }else{

                    $statistic_new = new Statistical();
                    $statistic_new->order_date = $order_date;
                    $statistic_new->sales = $sales;
                    $statistic_new->profit =  $profit;
                    $statistic_new->quantity =  $quantity;
                    $statistic_new->total_order = $total_order;
                    $statistic_new->save();
                }
            }
            else if ($order->order_status == 1 && $order->order_status != $request->value) {
                foreach ($data['order_product_id'] as $key => $product_id) {
                    $product = Product::find($product_id);
                    $product_qty = $product->product_quantity;
                    $product_sold = $product->product_sold;

                    if ($product->product_sold !=0) {
                        foreach ($data['quantity'] as $key2 => $qty) {
                            if ($key==$key2) {
                                $pro_remain = $product_qty + $qty;
                                $product->product_quantity = $pro_remain;
                                $product->product_sold = $product_sold - $qty;
                                $product->save();
                            }
                        }
                    }
                }
            }

            return response()->json([
                'status'=>200,
                'message'=>'Update Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Order Not Found',
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
        $order_de = OrderDetail::find($id);

        $validator = Validator::make($request->all(),[
            'order_text'=>'integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages(),
                'data'=>$order_de,
            ]);
        }else{
            $product = Product::where('product_id',$order_de->pro_id)->get();
            foreach($product as $proqty){
                if ($request->order_text > $proqty->product_quantity) {
                    return response()->json([
                        'status'=>404,
                        'data'=>$order_de,
                        'message'=>'Error Quantity Big'
                    ]);
                }else{
                    $order_de->order_de_qty = $request->order_text;
                    $order_de->save();

                    $subtotal = 0;
                    $total = 0;
                    $detail = OrderDetail::join('product','product.product_id','order_detail.pro_id')->where('order_code',$request->code_hidden)->get();
                    foreach($detail as $row){
                        $subtotal += $row->order_de_price*$row->order_de_qty;
                        if($row->order_de_coupon == 'no'){
                            $total = $subtotal;
                        }else{
                            $coupon = Coupon::where('coupon_code',$row->order_de_coupon)->first();
                            if($coupon->coupon_condition == 2){
                                $total = $subtotal-($subtotal*$coupon->coupon_sale_number/100);
                            }else{
                                $total = $subtotal-$coupon->coupon_sale_number;
                            }
                        }

                    }

                    return response()->json([
                        'status'=>200,
                        'subtotal'=>number_format($subtotal),
                        'total'=>number_format($total),
                        'message'=>'Update Successfully'
                    ]);
                }
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
        $sample = Order::findOrfail($id);
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
