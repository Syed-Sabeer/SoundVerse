<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function giftIndex()
    {
        $ordersgifts = \App\Models\GiftOrder::with('gift')->paginate(10); 


        return view('admin.orders.gift', compact('ordersgifts'));
    }
public function giftDestroy($id)
{
    $gift = \App\Models\GiftOrder::findOrFail($id);
    $gift->delete();

    return redirect()->back()->with('success', 'Gift Order deleted successfully.');
}


    public function ringIndex()
    {
        $ordersrings = \App\Models\RingOrder::orderBy('created_at', 'desc')->paginate(10); 

        return view('admin.orders.rings', compact('ordersrings'));
    }
public function ringDestroy($id)
{
    $ring = \App\Models\RingOrder::findOrFail($id);
    $ring->delete();

    return redirect()->back()->with('success', 'Ring Order deleted successfully.');
}


}
