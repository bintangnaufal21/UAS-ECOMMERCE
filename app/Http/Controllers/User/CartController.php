<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\OrderItem;
use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // tampilkan isi keranjang
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        return view('users.cart.index', compact('cart', 'total'));
    }

    // tambah buku ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $cart[$book->id]['qty'] += 1;
        } else {
            $cart[$book->id] = [
                'title' => $book->title,
                'price' => $book->price,
                'qty'   => 1,
                'image' => $book->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('users.cart.index')
            ->with('success', 'Buku ditambahkan ke keranjang.');
    }

    // update jumlah tiap item
    public function update(Request $request)
    {
        $quantities = $request->input('qty', []); // [book_id => qty]

        $cart = session()->get('cart', []);

        foreach ($quantities as $bookId => $qty) {
            if (isset($cart[$bookId])) {
                $qty = max(1, (int) $qty);
                $cart[$bookId]['qty'] = $qty;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('users.cart.index')
            ->with('success', 'Keranjang diperbarui.');
    }

    // hapus satu item
    public function remove(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
        ]);

        $cart = session()->get('cart', []);

        unset($cart[$request->book_id]);

        session()->put('cart', $cart);

        return redirect()->route('users.cart.index')
            ->with('success', 'Item dihapus dari keranjang.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('users.cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        return view('users.cart.checkout', compact('cart', 'total'));
    }


    public function processCheckout(Request $request)
    {
        $request->validate([
            'fullname'     => 'required|string|max:255',
            'address'      => 'required|string|max:500',
            'phone'        => 'required|string|max:20',
            'city'         => 'nullable|string|max:255',
            'postal_code'  => 'nullable|string|max:20',
            'email'        => 'nullable|email|max:255',
            'shipping'     => 'required|string|max:50', // jne, sicepat, jt, pos
            'payment'      => 'nullable|string|max:50',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('users.cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        // 1) Hitung subtotal barang
        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        // 2) Tentukan ongkir berdasarkan pilihan shipping
        $shippingMethod = $request->shipping;
        switch ($shippingMethod) {
            case 'sicepat':
                $shippingCost = 25000;
                break;
            case 'jt':
                $shippingCost = 22000;
                break;
            case 'pos':
                $shippingCost = 15000;
                break;
            case 'jne':
            default:
                $shippingCost = 20000;
                break;
        }

        // 3) Buat order
        $order = Order::create([
            'user_id'        => Auth::id(),
            'fullname'       => $request->fullname,
            'address'        => $request->address,
            'city'           => $request->city,
            'postal_code'    => $request->postal_code,
            'phone'          => $request->phone,
            'email'          => $request->email ?? Auth::user()->email ?? null,
            'shipping_method' => $shippingMethod,
            'payment_method' => $request->payment,
            'subtotal'       => $subtotal,
            'shipping_cost'  => $shippingCost,
            'total'          => $subtotal + $shippingCost,
            'status'         => 'pending',
        ]);

        // 4) Simpan item-item order
        foreach ($cart as $bookId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id'  => $bookId,
                'title'    => $item['title'],
                'price'    => $item['price'],
                'qty'      => $item['qty'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);
        }

        // 5) Kosongkan keranjang
        session()->forget('cart');

        return redirect()
            ->route('users.dashboard')
            ->with('success', 'Terima kasih, pesanan Anda sudah kami terima. Kode pesanan: #' . $order->id);
    }
}
