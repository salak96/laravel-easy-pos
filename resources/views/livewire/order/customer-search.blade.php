<div class="relative w-full">
    <input 
        type="text" 
        wire:keydown.Backspace='clear'
        wire:keydown.Delete='clear'
        wire:model.live.debounce.250ms="query" 
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="Select Customer..."
    />

    @if($selectedCustomer)
        <div class="absolute top-0 left-0 mt-1 ml-3 px-2 py-1 text-xs font-medium text-gray-700 bg-yellow-200 rounded-md shadow dark:text-gray-100 dark:bg-yellow-600">
            {{ $selectedCustomer->first_name . ' ' . $selectedCustomer->last_name }}
        </div>
    @endif

    @if($showDropdown and $query)
        <ul class="absolute left-0 right-0 mt-2 bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto z-20 dark:bg-gray-900 dark:border-gray-700">
            @foreach($customers as $customer)
                <li wire:click="selectCustomer({{ $customer->id }})" 
                    class="px-4 py-2 cursor-pointer text-gray-800 hover:bg-red-100 transition dark:hover:bg-blue-800 dark:text-gray-200">
                    {{ $customer->first_name . ' ' . $customer->last_name }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
