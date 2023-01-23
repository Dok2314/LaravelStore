<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket)->getOrder();

        return view('basket', compact('order'));
    }

    public function basketPlace()
    {
        $basket = new Basket;
        $order = $basket->getOrder();

        if(!$basket->countAvailable()) {
            session()->flash('warning', 'Товар не доступен для заказа');
            return redirect()->route('basket');
        }

        return view('order', compact('order'));
    }

    public function basketAdd(Sku $sku)
    {
        $result = (new Basket(true))->addSku($sku);

        if($result) {
            session()->flash('success', 'Добавлен товар: ' . $sku->product->__('name'));
        } else {
            session()->flash('warning', 'Товар: ' . $sku->product->__('name') . ' не доступен для заказа');
        }

        return redirect()->route('basket');
    }

    public function basketRemove(Sku $sku)
    {
        (new Basket())->removeSku($sku);

        session()->flash('warning', 'Удалён товар: ' . $sku->product->name);

        return redirect()->route('basket');
    }

    public function basketConfirm(Request $request)
    {
        if((new Basket)->saveOrder($request->phone, $request->email)) {
            session()->flash('success', 'Ваш заказ принят в разработку!');
        } else {
            session()->flash('warning', 'Товар не доступен для заказа!');
        }

        return redirect()->route('index');
    }
}
