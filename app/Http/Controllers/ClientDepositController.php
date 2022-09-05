<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientDeposit;
use App\ClientWallet;
use App\Http\Requests\Client\IndexClientRequest;
use App\Http\Requests\ClientDeposit\IndexClientDepositRequest;
use App\Http\Requests\ClientDeposit\StoreClientDepositRequest;
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
            $client = Client::with('clientDeposits')->get();
            return response()->json(
                [
                    'data' => $client
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
        $client = Client::where('user_id', $auth->id)->first();
        $clientDeposit = ClientDeposit::create($request->validated());

        return response()->json(
            [
                'clientDeposit' => $clientDeposit
            ]
        );
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
                    'data' => $client
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
