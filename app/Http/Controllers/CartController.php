<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use Illuminate\Http\Request;
use App\Models\Vaccine;
use App\Models\Order;
use App\Models\User;
use Cart;
use Hash;
use Auth;


class CartController extends Controller
{
    public function addToCart($slug) {
        $vaccine = Vaccine::with('hospital')->where('slug', $slug)->first();
        if( Cart::isEmpty() ) {
            Cart::add(array(
                'id' => $vaccine->id, // inique row ID
                'name' => $vaccine->name,
                'price' => $vaccine->price,
                'quantity' => 1,
                'attributes' => $vaccine
            ));
        } else {
            Cart::clear();
            Cart::add(array(
                'id' => $vaccine->id, // inique row ID
                'name' => $vaccine->name,
                'price' => $vaccine->price,
                'quantity' => 1,
                'attributes' => $vaccine
            ));
        }
        return redirect(route('checkout_view'));
    }

    public function checkoutView() {
        return view('ecommerce.checkout');
    }

    public function checkoutProcess(CheckoutRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'customer',
            'status' => 'Activated',
            'avatar' => null,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
        $vaccine_id = null;
        foreach( Cart::getContent() as $cart ) {
            $vaccine_id = $cart->id;
        }
        $status = "Processing";
        if( $request->payment == "banktransfer" || $request->payment == "cod" ) {
            $status = "On Hold";
        }

        $order = Order::create([
            'vaccine_id' => $vaccine_id,
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'date' => $request->date,
            'order_status' => $status,
            'dose' => $request->dose,
            'nic' => $request->nic,
            'orderTotal' => Cart::getTotal(),
            'payment_method' => $request->payment,
        ]);
        Cart::clear();
        Cart::clearCartConditions();
        return redirect(route('order-complete', $order->id));
    }

    public function orderComplete( $key ) {
        return view('ecommerce.thank-you', compact('key'));
    }
}
