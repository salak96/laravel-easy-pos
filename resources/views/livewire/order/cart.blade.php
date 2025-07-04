<div class="space-y-4">
    @if (session()->has('error'))
        <p class="text-red-500 text-sm">{{ session('error') }}</p>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full min-w-[600px] border border-black-300 dark:border-black-600 text-sm">
            <thead>
                <tr class="bg-black-200 dark:bg-black-700 text-black-800 dark:text-black-100">
                    <th class="px-3 py-2 border border-black-300 text-left w-3/5">Item</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6">Harga</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6">Pajak</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6">Jumlah</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (!is_countable($cartItems) || count($cartItems) < 1)
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-black-500 dark:text-black-400">
                            Tambahkan item terlebih dahulu. 
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
                        <livewire:order.cart-item 
                            :cartItem="$item" 
                            :currency_symbol="$currency_symbol" 
                            :order-id="$orderId"
                            :key="$item->id" 
                        />
                    @endforeach

                    {{-- Subtotal --}}
                    <tr class="bg-black-100 dark:bg-black-800 border-t border-black-300 dark:border-black-600">
                        <td colspan="3" class="px-4 py-2 text-right font-semibold">Subtotal</td>
                        <td colspan="2" class="px-4 py-2 text-center font-semibold">
                            {{ $currency_symbol . number_format($total_price, 0,  ',', '.') }}
                        </td>
                    </tr>

                    {{-- Pajak --}}
                    @foreach ($total_tax as $rate => $amount)
                        <tr class="border-t border-black-300 dark:border-black-600">
                            <td colspan="3" class="px-4 py-2 text-right font-semibold">Pajak @ {{ $rate }}%</td>
                            <td colspan="2" class="px-4 py-2 text-center font-semibold">
                                {{ $currency_symbol . number_format($amount, 0,  ',', '.') }}
                            </td>
                        </tr>
                    @endforeach

                    {{-- Grand Total --}}
                    <tr class="bg-yellow-100 dark:bg-yellow-700 border-t border-black-300 dark:border-black-600">
                        <td colspan="3" class="px-4 py-2 text-right font-bold text-red-600 dark:text-red-200">
                            Total Pembayaran
                        </td>
                        <td colspan="2" class="px-4 py-2 text-center font-bold text-red-600 dark:text-red-300">
                            {{ $currency_symbol . number_format($grand_total, 0,  ',', '.') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    {{-- Tombol Checkout --}}
    <button wire:click="checkout" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white rounded px-4 py-2 transition duration-150">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        <span>Checkout</span>
    </button>
</div>
