<?php

namespace App\Http\Controllers;

use App\Models\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cartItems=Auth::user()->carts;
        return Inertia::render('Cart/index',['cartItems'=>$cartItems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'product_id'=> 'required|exists:product,id',
            'quantity'=>'required|min:1|integer'
        ]);
        /** @var \App\Models\User $user */
        $user= Auth::user();
        $user->carts()->create([
            'product_id'=>$request->product_id,
            'quantity'=> $request->quantity
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
        $request->validate([
            'quantity'=>'required|integer|min:1'
        ]);
        if($cart->user_id !== Auth::id()){
            abort(403);
        }
        $cart->update([
            'quantity'=>$request->quantity,
        ]);
        return redirect()->back()->with('success', 'Item updated from cart successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
        if($cart->user_id !== Auth::id()){
            abort(403);
        }
        $cart->delete();
        return redirect()->back()->with('success', 'Item removed from cart successfully!');
    }
}
