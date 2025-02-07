
<div class="mx-auto">   
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class="relative">
        <input wire:model.live.debounce.250ms="query" type="search" id="default-search" class="bg-white block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search product..." />
    </div>
    <div class="mt-4">
        <div class="grid grid-cols-3 gap-2">
            @foreach ($products as $product)
            <div wire:click="addToCart({{$product->id}})" class=" bg-white border border-gray-300 rounded">
                <img src="{{url('img/img-placeholder.jpg')}}" alt="Product 1" class="object-contain max-h-full">
                <p class="text-gray-600 p-2 text-sm">{{$product->name}} ({{$product->quantity}})</p>
                <p class="text-gray-600 p-2 pt-0 text-md">{{$currency_symbol .  $product->price}}</p>
            </div> 
            @endforeach
        </div>
    </div>
</div>
