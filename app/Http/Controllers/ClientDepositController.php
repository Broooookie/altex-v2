<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientDeposit;
use App\ClientWallet;
use App\Http\Requests\Client\IndexClientRequest;
use App\Http\Requests\ClientDeposit\IndexClientDepositRequest;
use App\Http\Requests\ClientDeposit\StoreClientDepositRequest;
use App\Http\Requests\ClientDeposit\UpdateClientDepositRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexClientDepositRequest $request)
    {
        //
       $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $status = $request->input('status');
            $client = ClientDeposit::where('recharge_status', $status)->with('client')->get();
            return response()->json(
                [
                    'clients' => $client
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $client = Client::where('user_id', $auth->id)->with('clientDeposits')->first();
            return response()->json(
                [
                    'client' => $client
                ]
            );
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
    public function store(StoreClientDepositRequest $request)
    {
        //Logic here is add coin to wallet

        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {

            $coin = $request->input('coin_id');
            $transaction_type = $request->input('transaction_type');
            // dd($transaction_type);
            $included_in_performance = $request->input('included_in_performance');
            $mytime = Carbon::now();
            
            $client = Client::where('id', $request->input('client_id'))->first();
            $clientWallet = ClientWallet::where('client_id', $client->id)->where('coin_id', $coin)->first();
            // dd($clientWallet);

            if($clientWallet == null)
            {
                $clientWallet = ClientWallet::create(array_merge([
                    'client_id' => $client->id, 'coin_id' => $coin, 'wallet_balance' => 0
                ]));

                $clientDeposit = ClientDeposit::create(
                   array_merge( ['client_id' => $client->id, 'client_wallet_id' => $clientWallet->id, 
                                'top_up_account' => 'asd', 'recharge_status' => 'PENDING',
                                'ip_address' => $request->ip(), 'submission_time' => $mytime->toDateTimeString(),
                                'response_time' => $mytime->toDateTimeString()
                ], $request->validated())
                );

                return response()->json(
                    [
                        'deposits' => $clientDeposit
                    ]
                );
            }
            else
            {

                // dd($clientWallet->id, $clientWallet->coin_id);
                $clientDeposit = ClientDeposit::create(
                    array_merge( ['client_wallet_id' => $clientWallet->id, 'top_up_account' => 'asd', 'recharge_status' => 'PENDING',
                                     'ip_address' => $request->ip(), 'submission_time' => $mytime->toDateTimeString(),
                                     'response_time' => $mytime->toDateTimeString()
                 ], $request->validated())
                 );
 
                 return response()->json(
                     [
                         'deposits' => $clientDeposit
                     ]
                 );
            }

           

        }
        // $client = Client::where('user_id', $auth->id)->first();
        // $clientDeposit = ClientDeposit::create($request->validated());

        // return response()->json(
        //     [
        //         'clientDeposit' => $clientDeposit
        //     ]
        // );
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
    public function update(UpdateClientDepositRequest $request, ClientDeposit $deposit)
    {
        //
        $mytime = Carbon::now();
        $deposit = ClientDeposit::where('id', $deposit->id)->first();
        
        $deposit->update(
            [
                'recharge_status' => $request->input('status'),
                'response_time' =>  $mytime->toDateTimeString(),
            ]
        );

        if($deposit->recharge_status == 'DISSAPROVED')
        {
            return response()->json([
                'message' => 'success'
            ]);
        }
        else
        {
            if($deposit->transaction_type == 'RECHARGE')
            {
                $clientWallet = ClientWallet::where('id', $deposit->client_wallet_id)->where('client_id', $deposit->client_id)->first();
                $totalDeposit = $deposit->recharge_amount + $clientWallet->wallet_balance;
                
                $clientWallet->update(
                    [
                        'wallet_balance' => $totalDeposit
                    ]
                );
            }
            elseif($deposit->transaction_type == 'DEDUCTION')
            {
                $clientWallet = ClientWallet::where('id', $deposit->client_wallet_id)->where('client_id', $deposit->client_id)->first();
    
                if($clientWallet->wallet_balance <= 0)
                {
                    return response()->json(
                        [
                            'message' => 'SOMETHING WENT WRONG'
                        ]
                    );
                }
                else
                {   
                    $totalDeposit = $clientWallet->wallet_balance - $deposit->recharge_amount;
                    $clientWallet->update(
                    [
                        'wallet_balance' => $totalDeposit
                    ]
                );
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
        //
    }

    /** if deposit needs approval */
    public function updateWallet(Request $request)
    {

        $state = $request->input('state');
        $clientWalletId = $request->input('clientWalletId');

        if($state == 'APPROVED')
        {
            $clientWallet = ClientWallet::where('id', $clientWalletId)->where('coin_id', $request->input('coin_id'))->first();
            $deposit = $clientWallet + $request->input('recharge_amount');
            $clientWallet->update('wallet_balance', $deposit);

            return response()->json([
                'clientWallet' => $clientWallet
            ]);
        }
        else
        {
            return response()->json([
                'message' => 'not approved'
            ]);
        }
    }

    public function depositAudit(IndexClientDepositRequest $request)
    {
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $client = ClientDeposit::with('client')->where('recharge_status', 'PENDING')->get();
            return response()->json(
                [
                    'clients' => $client
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $client = ClientDeposit::with('client')->where('recharge_status', 'PENDING')->get();
            return response()->json(
                [
                    'data' => $client
                ]
            );
        }
    }

    public function depositRecord(IndexClientDepositRequest $request)
    {
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $client = ClientDeposit::with('client')->where('recharge_status', 'APPROVED')->get();
            return response()->json(
                [
                    'data' => $client
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $client = ClientDeposit::with('client')->where('recharge_status', 'APPROVED')->get();
            return response()->json(
                [
                    'data' => $client
                ]
            );
        }
    }
}
