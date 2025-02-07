<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class CartItem extends Component
{
    public $cartItem;

    public $currency_symbol;

    public $quantity;

    public function mount($cartItem)
    {
        $this->cartItem = $cartItem;
        $this->quantity = $cartItem->quantity;
    }

    #[On('cartUpdated')]
    public function cartUpdated(){
        $this->quantity = $this->cartItem->quantity;
    }


    public function removeFromCart()
    {
        $this->quantity = 0;
        $this->cartItem->delete();
        $this->dispatch('cartUpdated');
    }

    public function render()
    {

        if ($this->quantity > 0) {
            $this->cartItem->quantity = $this->quantity;
            $this->cartItem->save();
        } 
        return view('livewire.cart-item');
    }
}
