<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

/**
 *
 */
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);

        return view('auth.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.coupons.form');
    }


    /**
     * @param CouponRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CouponRequest $request)
    {
        Coupon::create([
            'code' => $request->code,
            'value' => $request->value,
            'type' => (bool) ($request->type ?? null),
            'currency_id' => $request->has('type') ? $request->currency_id : null,
            'only_once' => (bool) ($request->only_once ?? null),
            'expired_at' => $request->expired_at,
            'description' => $request->description,
        ]);

        return redirect()->route('coupons.index')->with('success', 'Купон: ' . $request->code . ' успешно создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        return view('auth.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('auth.coupons.form', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CouponRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $coupon->update([
            'code' => $request->code,
            'value' => $request->value,
            'type' => (bool) ($request->type ?? null),
            'currency_id' => $request->has('type') ? $request->currency_id : null,
            'only_once' => (bool) ($request->only_once ?? null),
            'expired_at' => $request->expired_at,
            'description' => $request->description,
        ]);

        return redirect()->route('coupons.index')->with('success', 'Купон: ' . $request->code . ' успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        session()->flash('success', 'Купон: ' . $coupon->code . ' был успешно удалён');

        $coupon->delete();

        return redirect()->route('coupons.index');
    }
}
