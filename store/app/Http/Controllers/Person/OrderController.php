<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->active()->get();

        return view('auth.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if(!auth()->user()->orders->contains($order)) {
            session()->flash('warning', 'Такого заказа не существует!');
            return redirect()->route('person.orders.index');
        }

        return view('auth.orders.show', compact('order'));
    }
}
