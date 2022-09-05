<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientWallet;
use App\ClientWithdraw;
use App\Http\Requests\ClientWithdraw\StoreClientWithdrawRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $client = Client::with('clientWithdraws')->get();
            return response()->json(
                [
                    'client' => $client
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $client = Client::where('user_id', $auth->id)->with('clientWithdraws')->first();
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
    public function store(StoreClientWithdrawRequest $request)
    {
        //
        $auth = Auth::user();
        $client = Client::where('user_id', $auth->id)->first();
        $clientWithdraw = ClientWithdraw::create($request->validated());
        $clientWallet = ClientWallet::where('client_id', $client->id)->where('coin_id', $request->input('coin_id'))->first();

        $withdraw = $clientWallet - $request->input('withdraw_amount');

        $clientWallet->update('wallet_balance', $withdraw);

        return response()->json(
            [
                'clientDeposit' => $clientWithdraw
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

    public function updateWallet(Request $request)
    {

        $state = $request->input('state');
        $clientWalletId = $request->input('clientWalletId');

        if($state == 'APPROVED')
        {
            $clientWallet = ClientWallet::where('id', $clientWalletId)->where('coin_id', $request->input('coin_id'))->first();
            $withdraw = $clientWallet - $request->input('withdraw_amount');
            $clientWallet->update('wallet_balance', $withdraw);

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
}
