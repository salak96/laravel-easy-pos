<div class="">

    @if (session()->has('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
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
        @if ( !is_countable($cartItems) || count($cartItems) < 1)
            <tr class="min-h-32"><td class="p-4">Add Items.</td></tr>
        @else
            @php $total_price = 0 @endphp
            @foreach ($cartItems as $item) 
                @php $total_price += ( $item->product->price * $item->quantity ); @endphp
                <livewire:order.cart-item :cartItem="$item" :currency_symbol="$currency_symbol" :order-id="$orderId" :key="$item->id" />
            @endforeach
            <tr class="odd:bg-white even:bg-gray-100 border-gray-400 border">
                <td class="px-4 py-2 dark:text-gray-800"></td>
                <td class="px-4 py-2 border-gray-400 border-r text-center dark:text-gray-800 font-semibold">Total</td>
                <td class="px-4 py-2 text-center font-semibold" colspan='2'>{{$currency_symbol}}{{number_format($total_price , 2, '.', '') }}</td>
            </tr>
        @endif
        </tbody>
    </table>

        <button wire:click="checkout" class="bg-green-500 rounded  text-white px-4 py-2 mt-3">
            <svg class="size-6 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>              
        </button>
</div>
