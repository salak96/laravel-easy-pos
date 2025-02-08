<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Attributes\On; 

class Cart extends Component
{
    public $cartItems = [];

    private $currency_symbol;

    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;  

        $this->cartItems = OrderItem::where('order_id', $orderId)            
                            ->orderBy('id', 'DESC')
                            ->get();    
        $currency_symbol = Setting::select('value')->where('key', 'currency_symbol')->first();
        $this->currency_symbol = $currency_symbol ? $currency_symbol->value : '';
    }

    
    public function render()
    {
        return view('livewire.order.cart', ['cartItems' => $this->cartItems, 'currency_symbol' => $this->currency_symbol]);
    }


    #[On('cartUpdated')]
    public function updateCart()
    {
        $this->cartItems = OrderItem::where('order_id', $this->orderId)            
                                        ->orderBy('id', 'DESC')
                                        ->get();
    }


    public function checkout(){ return;
        
        $total_price = 0;
        $order = Order::create([
            'customer_id' => 1,
            'total_price' => $total_price
        ]);

        $items = $this->cartItems;

        if( ! is_countable( $items ) ){
            return;
        }

        foreach ($items as $item) {  
            $product = Product::find( $item->product_id );

            $order->items()->create([
                'price' => $product->price,
                'quantity' => $item->quantity,
                'product_id' => $item->product_id,
            ]);
            $total_price += $item->quantity * $product->price;
            $product->quantity = $product->quantity - $item->quantity;
            $product->save();
        }
        
        $order->total_price = $total_price;
        $order->save();

        $this->cartItems = CartModel::where('user_id', auth()->user()->id)
                            ->delete();  

        $this->dispatch('checkout-completed');

    }

}
