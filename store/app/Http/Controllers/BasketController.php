<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\AddCouponRequest;
use App\Models\Sku;
use Illuminate\Http\Request;
use App\Models\Coupon;

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
        $basket = new Basket;

        if($basket->getOrder()->hasCoupon() && !$basket->getOrder()->coupon->availableForUse()) {
            $basket->clearCoupon();
            session()->flash('warning', 'Купон не доступен для использования!');
            return redirect()->route('basket');
        }

        if($basket->saveOrder($request->phone, $request->email)) {
            session()->flash('success', 'Ваш заказ принят в разработку!');
        } else {
            session()->flash('warning', 'Товар не доступен для заказа!');
        }

        return redirect()->route('index');
    }

    public function setCoupon(AddCouponRequest $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();

        if($coupon->availableForUse()) {
            (new Basket())->setCoupon($coupon);
            session()->flash('success', 'Купон был успешно добавлен!');
        } else {
            session()->flash('warning', 'Купон не может быть использован!');
        }

        return redirect()->route('basket');
    }
}
