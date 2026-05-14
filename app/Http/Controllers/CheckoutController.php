<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        if ($request->address_mode === 'saved' && $request->address_id) {
            $request->validate([
                'address_id' => 'required|exists:addresses,id',
                'payment_method' => 'required|in:COD',
            ]);
            $address = Address::find($request->address_id);
            if ($address->user_id !== auth()->id()) {
                abort(403);
            }
            $addressData = $address->toArray();
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'address_line_1' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|string',
                'zip_code' => 'required|string',
                'phone' => 'required|string',
                'payment_method' => 'required|in:COD',
            ]);
            
            $addressData = [
                'name' => $request->name,
                'address_line_1' => $request->address_line_1,
                'address_line_2' => $request->address_line_2,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'phone' => $request->phone,
            ];
        }

        $cart = Cart::with('items.product')->where('user_id', auth()->id())->first();
        
        if (!$cart || $cart->items->count() == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            // Always save address if it's a new one
            if ($request->address_mode === 'new') {
                Address::create(array_merge($addressData, ['user_id' => auth()->id()]));
            }

            $totalAmount = $cart->items->sum(fn($i) => ($i->product->discount_price ?? $i->product->price) * $i->quantity);

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_amount' => $totalAmount,
                'status' => 'Pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'Pending',
                'notes' => $request->notes,
                'name' => $addressData['name'],
                'address_line_1' => $addressData['address_line_1'],
                'address_line_2' => $addressData['address_line_2'] ?? null,
                'city' => $addressData['city'],
                'state' => $addressData['state'],
                'zip_code' => $addressData['zip_code'],
                'phone' => $addressData['phone'],
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->discount_price ?? $item->product->price,
                ]);

                // Update stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            $cart->items()->delete();

            DB::commit();
            return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
