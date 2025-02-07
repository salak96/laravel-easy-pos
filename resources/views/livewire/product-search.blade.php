
<div class="mx-auto">   
    <div class="relative">
        <input wire:model.live.debounce.250ms="query" type="search" id="default-search" class="bg-white block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search product..." />
    </div>
    <div class="mt-4">
        <div class="grid grid-cols-3 gap-2">
            @foreach ($products as $product)
            <div wire:click="addToCart({{$product->id}})" class="relative bg-white border border-gray-300 rounded">
                <img src="{{$product->getImageUrl()}}" alt="Product 1" class="object-contain max-h-full">
                <p class="text-gray-600 p-2 text-sm">{{$product->name}} ({{$product->quantity}})</p>
                <p class="text-gray-600 p-2 pt-0 text-md">{{$currency_symbol .  $product->price}}</p>
                @if($product->quantity < 1)
                <div class="absolute top-1 right-1 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                    Out of Stock
                </div>
                @endif
            </div> 
            @endforeach
        </div>
    </div>
</div>
