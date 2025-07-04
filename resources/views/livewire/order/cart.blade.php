<div class="space-y-4">
    @if (session()->has('error'))
        <p class="text-red-500 text-sm">{{ session('error') }}</p>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] border border-gray-300 dark:border-gray-600 text-sm">
            <thead>
                <tr class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <th class="px-3 py-2 border border-gray-300 text-left w-3/5">Item</th>
                    <th class="px-3 py-2 border border-gray-300 text-center w-1/6">Rate</th>
                    <th class="px-3 py-2 border border-gray-300 text-center w-1/6">Pajak</th>
                    <th class="px-3 py-2 border border-gray-300 text-center w-1/6">Quantity</th>
                    <th class="px-3 py-2 border border-gray-300 text-center w-1/6">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (!is_countable($cartItems) || count($cartItems) < 1)
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-gray-400">
                            Add Items.
                        </td>
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
                            $gst_amount = ($item_total * $tax) / 100;
                            $item_total_with_gst = $item_total + $gst_amount;
                            $total_price += $item_total;
                            $total_tax[$tax] = ($total_tax[$tax] ?? 0) + $gst_amount;
                            $grand_total += $item_total_with_gst;
                            $item->item_total_with_gst = $item_total_with_gst;
                        @endphp
                        <livewire:order.cart-item :cartItem="$item" :currency_symbol="$currency_symbol" :order-id="$orderId"
                            :key="$item->id" />
                    @endforeach

                    <tr class="bg-gray-100 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-600">
                        <td colspan="3" class="px-4 py-2 text-right font-semibold">Subtotal</td>
                        <td colspan="2" class="px-4 py-2 text-center font-semibold">
                            {{ 'Rp ' . number_format($total_price, 0, ',', '.') }}
                        </td>
                    </tr>

                    @foreach ($total_tax as $rate => $amount)
                        <tr class="border-t border-gray-300 dark:border-gray-600">
                            <td colspan="3" class="px-4 py-2 text-right font-semibold">Pajak @ {{ $rate }}%</td>
                            <td colspan="2" class="px-4 py-2 text-center font-semibold">
                                {{ $currency_symbol }}{{ number_format($amount, 2) }}
                            </td>
                        </tr>
                    @endforeach

                    <tr class="bg-yellow-100 dark:bg-yellow-700 border-t border-gray-300 dark:border-gray-600">
                        <td colspan="3" class="px-4 py-2 text-right font-bold text-red-600 dark:text-red-200">
                            Total Pembayaran
                        </td>
                        <td colspan="2" class="px-4 py-2 text-center font-bold text-red-600 dark:text-red-300">
                            {{ $currency_symbol }}{{ number_format($grand_total, 2) }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <button wire:click="checkout" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white rounded px-4 py-2 transition duration-150">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span>Checkout</span>
    </button>
</div>
