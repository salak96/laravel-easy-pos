<tr class="odd:bg-white even:bg-gray-100">
    <td class="px-4 py-2 border-r">{{ $cartItem->product->name }}</td>
    <td class="px-4 py-2 border-r text-center">{{ $cartItem->product->price }}</td>
    <td class="px-4 py-2 border-r text-center">
        <div class="flex items-center gap-1">
            <input type="number" min="1" wire:model.live.debounce.250ms="quantity"  class="bg-white text-center block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            <button wire:click="removeFromCart"  class="p-2 text-white bg-red-500 rounded hover:bg-red-600" title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </td>
    
    <td class="px-4 py-2 text-center">{{ number_format($cartItem->product->price * $cartItem->quantity , 2, '.', '') }}</td>
</tr>
