<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientWallet;
use App\Http\Requests\ClientWallet\IndexClientWalletRequest;
use App\Http\Requests\ClientWallet\StoreClientWalletRequest;
use App\Http\Requests\ClientWallet\UpdateClientWalletRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientWalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexClientWalletRequest $request)
    {
        //
        $auth = Auth::user();
        if($auth->role =='ADMINISTRATOR')
        {
            $client = Client::with('clientWallets')->get();

            return response()->json(
                [
                    'client' => $client
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $client = Client::where('user_id', $auth->id)->with('clientWallets')->first();
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
    public function store(StoreClientWalletRequest $request)
    {
        //
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $clientWallet = ClientWallet::create($request->validated());

            return response()->json(
                [
                    'clientWallet' => $clientWallet
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $clientWallet = ClientWallet::create($request->validated());

            return response()->json(
                [
                    'clientWallet' => $clientWallet
                ]
            );
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
    public function update(UpdateClientWalletRequest $request, ClientWallet $clientWallet)
    {
        //
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR')
        {
            $clientWallet = ClientWallet::where('client_wallet_id', $clientWallet)->first();
            $clientWallet->update($request->validated());

            return response()->json(
                [
                    'clientWallet' => $clientWallet
                ]
            );
        }
        elseif($auth->role == 'CLIENT')
        {
            $clientWallet = ClientWallet::where('client_wallet_id', $clientWallet)->first();
            $clientWallet->update($request->validated());

            return response()->json(
                [
                    'clientWallet' => $clientWallet
                ]
            );
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
}
