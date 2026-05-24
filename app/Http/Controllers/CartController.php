<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * View the shopping cart
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('cart', compact('cart', 'subtotal'));
    }

    /**
     * Add an item to the shopping cart
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = (int) $request->input('quantity', 1);

        if ($quantity <= 0) {
            return redirect()->back()->with('error', 'Cantidad inválida.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'quantity' => $quantity,
                'price' => $product->price,
                'image_path' => $product->image_path,
                'slug' => $product->slug,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', '¡Producto añadido al carrito!');
    }

    /**
     * Update product quantity in the cart
     */
    public function update(Request $request, $id)
    {
        $quantity = (int) $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', '¡Carrito actualizado!');
            } else {
                // If quantity is 0 or less, remove it
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
            }
        }

        return redirect()->route('cart.index')->with('error', 'No se pudo actualizar el producto.');
    }

    /**
     * Remove an item from the cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto removido del carrito.');
    }

    /**
     * Clear all items in the cart
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado correctamente.');
    }
}
