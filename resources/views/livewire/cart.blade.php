<div class="">

    @if (session()->has('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif

    @if (empty($cartItems))
        <p>Your cart is empty.</p>
    @else
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border border-gray-400 text-left w-3/5 dark:text-gray-800">Item</th>
                    <th class="px-4 py-2 border border-gray-400 text-center w-1/6 dark:text-gray-800">Price</th>
                    <th class="px-4 py-2 border border-gray-400 text-center w-1/3 dark:text-gray-800">Quantity</th>
                    <th class="px-4 py-2 border border-gray-400 text-center w-1/6 dark:text-gray-800">Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <livewire:cart-item :cartItem="$item" :currency_symbol="$currency_symbol" :key="$item->id" />
            @endforeach
            </tbody>
        </table>

        <button wire:click="clearCart" class="bg-red-500 text-white px-4 py-2 mt-3">Clear Cart</button>
    @endif
</div>
