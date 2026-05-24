<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected PaymentService $paymentService;

    /**
     * Inject PaymentService dynamically
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * View the checkout form
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('catalog.index')->with('error', 'El carrito está vacío para procesar la compra.');
        }

        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return view('checkout', compact('cart', 'subtotal'));
    }

    /**
     * Store a newly created order and charge the customer
     */
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('catalog.index')->with('error', 'El carrito está vacío.');
        }

        // Form Validation
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'nullable|string|max:30',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:100',
            'shipping_country' => 'required|string|max:100',
            'payment_gateway' => 'required|in:mock,stripe,paypal',
        ]);

        $subtotal = 0;
        foreach ($cart as $id => $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        // 1. Process payment charge via dynamic Gateway
        $gateway = $this->paymentService->getGateway($request->payment_gateway);
        $paymentResult = $gateway->charge($subtotal, [
            'name' => $request->customer_name,
            'email' => $request->customer_email,
        ]);

        // If the charge failed, return back with details
        if (!$paymentResult['success']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Fallo al procesar el pago: ' . ($paymentResult['error'] ?? 'Transacción rechazada.'));
        }

        // 2. Transaction database save (Atomicity)
        try {
            DB::beginTransaction();

            $order = Order::create([
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_country' => $request->shipping_country,
                'total' => $subtotal,
                'status' => 'paid', // Succeeded payments
                'payment_gateway' => $request->payment_gateway,
                'payment_id' => $paymentResult['transaction_id'],
            ]);

            // Save order items and decrement stocks
            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);

                // Reduce inventory stock
                $product = Product::find($productId);
                if ($product) {
                    $product->decrement('stock', $item['quantity']);
                }
            }

            DB::commit();

            // Clear session cart
            session()->forget('cart');

            return redirect()->route('checkout.success', $order->id)
                ->with('success', '¡Compra procesada con éxito! Tu orden ya ha sido registrada.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving checkout order: ' . $e->getMessage());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error interno al registrar tu orden: ' . $e->getMessage());
        }
    }

    /**
     * Show success thank-you page
     */
    public function success($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('success', compact('order'));
    }
}
