<?php

namespace App\Livewire\Order;

use App\Models\Product;
use App\Models\Cart;
use Livewire\Component;

class BarcodeScan extends Component
{
    public $query = '';

    public $error = '';

    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function render()
    {
        return view('livewire.order.barcode-scan');
    }


    public function addToCart(){
        $this->error = '';
        $quantity = 1;
        $product = Product::where('barcode', $this->query)->first();
        if( !$product ){
            $this->error = 'The '. $this->query . ' ' . ' - Product which does not exist!';
            $this->query = '';
            return;
        }
        $user_id = auth()->user()->id;
        $cart = Cart::firstOrCreate(
            ['user_id' => $user_id, 'product_id' => $product->id],  
            ['quantity' => 0] 
        );
        
        $cart->update([
            'quantity' => $cart->quantity + $quantity
        ]);

        $product->quantity = $product->quantity - $quantity;
        $product->save();

        $this->query = '';

        $this->dispatch('cartUpdated');
    }

    public function closeErrorModal(){
        $this->error = '';
    }
}
