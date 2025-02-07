<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart as CartModel;
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

}
