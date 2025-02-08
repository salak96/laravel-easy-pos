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


    public function checkout(){ 
        return;
    }

}
