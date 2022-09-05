<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\Order\IndexOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Order;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexOrderRequest $request)
    {
        //
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $order = Client::with('orders')->get();
        }
        elseif($auth->role == 'CLIENT')
        {
            $order = Client::where('user_id', $auth->id)->with('orders')->get();
        }
        
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

    public function buyOrder(StoreOrderRequest $request)
    {
        $auth = Auth::user();
        $client = Client::where('user_id', $auth->id)->get();
        $numberOfOrder = $request->input('number_of_order');
        $orderPerUnit = $request->input('order_per_unit');
        $mytime = Carbon::now();
        if($auth->role == 'CLIENT')
        {

            /** Formula */
            /** Total_buy_order = number of order / order_per_unit  */
            /** for example */
            /** Buy xrp(0.323) with 200 usdt */
            /** total_buy_order = 200 / 0.323  */
            /** total_commission = 619.19 * 0.327*/
            /** total_commission is 202 increased $2 */
            $totalBuyOrder = $numberOfOrder / $orderPerUnit;
            $totalCommission = $totalBuyOrder * $orderPerUnit;
            $buyOrder = Order::create(array_merge([
                'role' => 'CLIENT',
                'delegate_type' => 'BUY',
                'total_commission' => $totalCommission,
                'final_price' => $orderPerUnit,
                'volume' => $totalBuyOrder,
                'turnover' => $totalCommission,
                'commission_time' => $mytime->toDateTimeString(),
                'last_modified' => $mytime->toDateTimeString(),

            ],
                $request->validated()
            ));

            return response()->json(
                [
                    'order' => $buyOrder
                ]
            );
        }
    }

    public function sellOrder(StoreOrderRequest $request)
    {
        $auth = Auth::user();
        $client = Client::where('user_id', $auth->id)->get();
        $numberOfOrder = $request->input('number_of_order');
        $orderPerUnit = $request->input('order_per_unit');
        $trading_pair = $request->input('trading_pair');

        $mytime = Carbon::now();

        $order = Order::where('trading_pair', $trading_pair)
                        ->where('client_id', $client->id)
                        ->orderBy('commission_time', 'DESC')->first();
        if($auth->role == 'CLIENT')
        {
            /** Formula */
            /** Total_buy_order = number of order / order_per_unit  */
            /** for example */
            /** Sell 619.19 xrp */
            /** total_sell_order = 619.19 * 0.327  */
            /** If sell is win */
            /** total_commission = 200 + (202.47 - 200) */
            /** total_commission is 202 increased $2 */
            /** If sell is lose */
            /** total_sell_order = 619.19 * 0.3  */
            //** total_commission = 200 + (185.75 - 200) */
            //** total_commission */
            /** total_commission is 202 decreased by $14.25 */


            $totalSellOrder = $numberOfOrder * $orderPerUnit;
            $totalCommission = $order->total_commission + ($totalSellOrder - $order->total_commission);
            $sellOrder = Order::create(array_merge([
                'role' => 'CLIENT',
                'delegate_type' => 'SELL',
                'total_commission' => $totalCommission,
                'final_price' => $orderPerUnit,
                'volume' => $totalSellOrder,
                'turnover' => $totalCommission,
                'commission_time' => $mytime->toDateTimeString(),
                'last_modified' => $mytime->toDateTimeString(),
            ],
                $request->validated()
            ));

            return response()->json(
                [
                    'order' => $sellOrder
                ]
            );

        }
    }

    
    /** Save for later */ 
    // function generateBarcodeNumber() {
    //     $number = mt_rand(1000000000, 9999999999); // better than rand()
    
    //     // call the same function if the barcode exists already
    //     if ($this->barcodeNumberExists($number)) {
    //         return $this->generateBarcodeNumber();
    //     }
    
    //     // otherwise, it's valid and can be used
    //     return $number;
    // }

    // function barcodeNumberExists($number) {
    //     // query the database and return a boolean
    //     // for instance, it might look like this in Laravel
    //     return User::whereBarcodeNumber($number)->exists();
    // }
    
    
}
