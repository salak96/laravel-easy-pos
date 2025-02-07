<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Livewire\Attributes\On; 

class Cart extends Component
{
    public $cartItems = [];

    private $currency_symbol;

    public function mount()
    {
        $this->cartItems = CartModel::with('product')
                            ->where('user_id', auth()->user()->id)
                            ->orderBy('id', 'DESC')
                            ->get();    

        $currency_symbol = Setting::select('value')->where('key', 'currency_symbol')->first();
        $this->currency_symbol = $currency_symbol ? $currency_symbol->value : '';
    }

    
    public function render()
    {
        return view('livewire.cart', ['cartItems' => $this->cartItems, 'currency_symbol' => $this->currency_symbol]);
    }


    #[On('cartUpdated')]
    public function updateCart()
    {
        $this->cartItems = CartModel::with('product')
            ->where('user_id', auth()->user()->id)
            ->orderBy('id', 'DESC')
             ->get();
    }


    public function checkout(){
        
        $order = Order::create([
            'customer_id' => 1,
        ]);

        $items = $this->cartItems;


        foreach ($items as $item) {  
            $product = Product::find( $item->product_id );

            $order->items()->create([
                'price' => $product->price,
                'quantity' => $item->quantity,
                'product_id' => $item->product_id,
            ]);
            $product->quantity = $product->quantity - $item->quantity;
            $product->save();
        }


        $this->cartItems = CartModel::where('user_id', auth()->user()->id)
                            ->delete();  

        $this->dispatch('checkout-completed');

    }

}
