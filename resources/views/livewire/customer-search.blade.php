<div class="relative w-full">
    <input 
    type="text" 
    wire:model.live.debounce.250ms="query" 
    class="bg-white block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
    placeholder="Select Customer..."
/>

@if($showDropdown)
    <ul class="absolute left-0 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-md z-10">
        @foreach($customers as $customer)
            <li wire:click="selectCustomer({{ $customer->id }})" 
                class="px-4 py-2 cursor-pointer hover:bg-blue-100 dark:text-white">
                {{ $customer->first_name . ' ' . $customer->last_name }}
            </li>
        @endforeach
    </ul>
@endif
</div>
