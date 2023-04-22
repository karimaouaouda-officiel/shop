<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShopRequest;
use App\Models\UnverifiedShop;
use App\Http\Requests\StoreUnverifiedShopRequest;
use App\Http\Requests\UpdateUnverifiedShopRequest;
use Illuminate\Support\Facades\Auth;

class UnverifiedShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreUnverifiedShopRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShopRequest $request)
    {
        $shop = new UnverifiedShop($request->all());
        $shop->user_id = Auth::user()->id;
        $shop->save();

        return response("great" , 200);


    }

    public function clone(StoreShopRequest $request){
        return $this->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnverifiedShop  $unverifiedShop
     * @return \Illuminate\Http\Response
     */
    public function show(UnverifiedShop $unverifiedShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnverifiedShop  $unverifiedShop
     * @return \Illuminate\Http\Response
     */
    public function edit(UnverifiedShop $unverifiedShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnverifiedShopRequest  $request
     * @param  \App\Models\UnverifiedShop  $unverifiedShop
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnverifiedShopRequest $request, UnverifiedShop $unverifiedShop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnverifiedShop  $unverifiedShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnverifiedShop $unverifiedShop)
    {
        //
    }
}
