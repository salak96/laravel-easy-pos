<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Cart;
use Livewire\Attributes\On; 

class ProductSearch extends Component
{
    public $query = '';

    public function render()
    {
        $products = Product::where('name', 'like', '%' . $this->query . '%')->limit(10)->get();
        $currency_symbol = Setting::select('value')->where('key', 'currency_symbol')->first();
        $currency_symbol = $currency_symbol ? $currency_symbol->value : '';
        return view('livewire.product-search', compact('products', 'currency_symbol'));
    }

    #[On('checkout-completed')]
    public function checkoutCompleted(){
        $this->query = '';
    }



    public function addToCart( $product_id, $quantity = 1 ){

        $product = Product::find( $product_id );
        $user_id = auth()->user()->id;
        $cartItem = Cart::firstOrCreate(
            ['user_id' => $user_id, 'product_id' => $product_id],  
            ['quantity' => 0] 
        );

        if( $product->quantity < ($cartItem->quantity + $quantity) ){
            $cartItem->delete();
            return;
        }
        
        $cartItem->update([
            'quantity' => $cartItem->quantity + $quantity
        ]);

        $this->dispatch('cartUpdated');
    }

}
