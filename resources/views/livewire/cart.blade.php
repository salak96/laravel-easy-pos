<div class="space-y-4">

    @if (session()->has('error'))
        <p class="text-red-500 text-sm">{{ session('error') }}</p>
    @endif

    <div class="overflow-x-auto md:overflow-visible">
        <table class="w-full min-w-[600px] border border-gray-300 text-sm dark:border-black-600">
            <thead>
                <tr class="bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-neutral-100">
                    <th class="px-3 py-2 border border-gray-300 text-left w-3/5 dark:border-black-600">Item</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6 dark:border-black">Harga</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6 dark:border-black">Pajak (%)</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6 dark:border-black">Qty</th>
                    <th class="px-3 py-2 border border-black-300 text-center w-1/6 dark:border-black">Total</th>
                </tr>
            </thead>

            <tbody class="text-gray-800 dark:text-black-100">
                {{-- Check if cart is empty --}}
                @if (!is_countable($cartItems) || count($cartItems) < 1)
                    <tr>
                        <td colspan="5" class="px-4 py-6 text-center text-gray-500 dark:text-red">
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
                            $tax_amount = ($item_total * $tax) / 100;
                            $item_total_with_tax = $item_total + $tax_amount;
                            $total_price += $item_total;
                            $total_tax[$tax] = ($total_tax[$tax] ?? 0) + $tax_amount;
                            $grand_total += $item_total_with_tax;
                        @endphp
                        <livewire:cart-item :cartItem="$item" :currency_symbol="$currency_symbol" :key="$item->id" />
                    @endforeach

                    <tr class="bg-gray-100 dark:bg-gray-800 border-t border-gray-300 dark:border-gray-600 text-white">
                        <td colspan="3" class="px-4 py-2 text-right font-semibold text-white">Subtotal</td>
                        <td colspan="2" class="px-4 py-2 text-center font-semibold">
                            {{ 'Rp ' . number_format($total_price, 0, ',', '.') }}
                        </td>
                    </tr>

            @foreach ($total_tax as $rate => $amount)
    <tr class="border-t border-gray-300 dark:border-gray-600">
        <td colspan="3" class="px-4 py-2 text-right font-semibold text-gray-800 dark:text-white">
            Pajak {{ $rate }}%
        </td>
        <td colspan="2" class="px-4 py-2 text-center font-semibold text-gray-800 dark:text-white">
            {{ 'Rp ' . number_format($amount, 0, ',', '.') }}
        </td>
    </tr>
@endforeach


                    <tr class="dark:bg-red-700 border-t border-gray-300 dark:border-gray-600">
                        <td colspan="3" class="px-4 py-2 text-right font-bold text-red-700 dark:text-red-200">
                            Total Pembayaran
                        </td>
                        <td colspan="2" class="px-4 py-2 text-center font-bold text-red-700 dark:text-red-200">
                            {{ 'Rp ' . number_format($grand_total, 0, ',', '.') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="text-right">
        <button wire:click="checkout" wire:loading.attr="disabled"
            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded transition duration-150">
            <span wire:loading.remove wire:target="checkout">Simpan</span>
            <span wire:loading wire:target="checkout"
                class="w-4 h-4 border-2 border-t-white border-transparent rounded-full animate-spin"></span>
        </button>
    </div>
</div>
