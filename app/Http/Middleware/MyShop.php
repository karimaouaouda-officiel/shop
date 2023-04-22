<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;

class MyShop
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $shop = $user->shop;

        if( $shop == null ){
            $ushop = $user->unverifiedShop();
            if( $ushop != null ){
                return abort(401 , "your shop isn't verified yet");
            }else{
                return abort(401 , "you must create shop to post a product");
            }
        }
        if($shop->user->id != auth()->user()->id ){
            return back()->withErrors(["you can not enter to this shop"]);
        }

        return $next($request);
    }
}
