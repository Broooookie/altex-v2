<?php

namespace App\Http\Controllers;

use App\Coin;
use App\Http\Requests\Coin\IndexCoinRequest;
use App\Http\Requests\Coin\StoreCoinRequest;
use App\Http\Requests\Coin\UpdateCoinRequest;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(IndexCoinRequest $request)
    {
        //
        $coins = Coin::with('coinWallets')->get();

        return response()->json(
            [
                'coins' => $coins
            ]
        );
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
    public function store(StoreCoinRequest $request)
    {
        //
        $coin = Coin::create($request->validated());
        
        return response()->json(
            [
                'coin' => $coin
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
    public function update(UpdateCoinRequest $request, Coin $coin)
    {
        //
        $coin = Coin::where('id', $coin)->first();
        $coin->update($request->validated());

        return response()->json(
            [
                'coin' => $coin
            ]
        );
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
