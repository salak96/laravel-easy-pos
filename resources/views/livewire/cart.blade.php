<div class="">

    @if (session()->has('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    <div class="overflow-x-auto md:overflow-x-none">
        <table class="min-w-[600px] min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-2 py-2 border border-gray-400 text-left w-3/5 dark:text-gray-800">Item</th>
                    <th class="px-2 py-2 border border-gray-400 text-center w-1/6 dark:text-gray-800">Harga</th>
                    <th class="px-2 py-2 border border-gray-400 text-center w-1/6 dark:text-gray-800">Pajak(%)</th>
                    <th class="px-2 py-2 border border-gray-400 text-center w-1/6 dark:text-gray-800">Quantity</th>
                    <th class="px-2 py-2 border border-gray-400 text-center w-1/6 dark:text-gray-800">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (!is_countable($cartItems) || count($cartItems) < 1)
                    <tr class="min-h-32">
                        <td class="p-4">Add Items.</td>
                    </tr>
                @else
                    @php
                        $total_price = 0;
                        $total_tax = [];
                        $grand_total = 0;
                    @endphp

                    @foreach ($cartItems as $item)
                        @php
                            $tax = $item->tax;
                            $item_total = $item->price * $item->quantity;
                            $tax_amount = ($item_total * $tax) / 100;
                            $item_total_with_tax = $item_total + $tax_amount;
                            $total_price += $item_total;
                            $total_tax[$tax] = ($total_tax[$tax] ?? 0) + $tax_amount;
                            $grand_total += $item_total_with_tax;
                        @endphp
                        <livewire:cart-item :cartItem="$item" :currency_symbol="$currency_symbol" :key="$item->id" />
                    @endforeach

                  <tr class="border-gray-400 border">
    <td colspan="3" class="px-4 py-2 border-r text-right font-semibold">Subtotal</td>
    <td colspan="2" class="px-4 py-2 text-center font-semibold">{{ 'Rp ' . number_format($total_price, 0, ',', '.') }}</td>
</tr>

@foreach ($total_tax as $rate => $amount)
    <tr class="border-gray-400 border">
        <td colspan="3" class="px-4 py-2 border-r text-right font-semibold">Pajak {{ $rate }}%</td>
        <td colspan="2" class="px-4 py-2 text-center font-semibold">{{ 'Rp ' . number_format($amount, 0, ',', '.') }}</td>
    </tr>
@endforeach

<tr class="bg-gray-100 border-gray-400 border text-red-600">
    <td colspan="3" class="px-4 py-2 border-r text-right font-bold  text-red-600">Total Pembayaran</td>
    <td colspan="2" class="px-4 py-2 text-center font-bold">{{ 'Rp ' . number_format($grand_total, 0, ',', '.') }}</td>
</tr>

                    @foreach ($total_tax as $rate => $amount)
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <button wire:click="checkout" wire:loading.attr="disabled" class="bg-green-500 rounded  text-white px-4 py-2 mt-3">
        <span wire:loading.remove wire:target='checkout'>Save</span>
        <span wire:loading wire:target='checkout'
            class="w-4 h-4 border-2 border-t-red-100 border-transparent rounded-full animate-spin"></span>
    </button>
</div>
