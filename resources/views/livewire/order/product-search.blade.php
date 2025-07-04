<div class="mx-auto px-4">
    <div class="relative">
        <input 
            wire:model.live.debounce.250ms="query" 
            type="search" 
            id="default-search" 
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md bg-white focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-red dark:focus:ring-blue-500 dark:focus:border-blue-500" 
            placeholder="Search product..." 
        />
    </div>

    <div class="mt-4">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @php $counter = 0; @endphp
            @foreach ($products as $product)
                <div 
                    wire:click="addToCart({{ $product->id }})" 
                    class="relative bg-white border border-gray-300 rounded-md shadow hover:shadow-md transition cursor-pointer {{ $counter > 1 ? 'hidden md:block' : '' }}"
                >
                    {{-- Loading overlay --}}
                    <div 
                        wire:loading 
                        wire:target="addToCart({{ $product->id }})"  
                        class="absolute inset-0 bg-gray-100 bg-opacity-80 flex items-center justify-center z-10"
                    >
                        <svg class="h-12 w-12 text-red-500" viewBox="0 0 120 30" fill="currentColor">
                            <circle cx="15" cy="15" r="10" fill="red">
                                <animate attributeName="opacity" values="0;1;0" dur="1.5s" repeatCount="indefinite"/>
                            </circle>
                            <circle cx="60" cy="15" r="10" fill="red">
                                <animate attributeName="opacity" values="0;1;0" dur="1.5s" repeatCount="indefinite" begin="0.3s"/>
                            </circle>
                            <circle cx="105" cy="15" r="10" fill="red">
                                <animate attributeName="opacity" values="0;1;0" dur="1.5s" repeatCount="indefinite" begin="0.6s"/>
                            </circle>
                        </svg>
                    </div>

                    {{-- Product Image --}}
                    <img 
                        src="{{ $product->getImageUrl() }}" 
                        alt="{{ $product->name }}" 
                        class="object-contain w-full h-40 p-2" 
                    />

                    {{-- Product Info --}}
                    <div class="p-2">
                        <p class="text-gray-800 text-sm font-medium">
                            {{ $product->name }} ({{ $product->quantity }})
                        </p>
                        <p class="text-gray-600 text-md">
                            {{ $currency_symbol . number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Out of stock badge --}}
                    @if($product->quantity < 1)
                        <div class="absolute top-2 right-2 bg-white-600 text-white text-xs font-bold px-2 py-1 rounded">
                            Out of Stock
                        </div>
                    @endif
                </div>
                @php $counter++; @endphp
            @endforeach
        </div>
    </div>
</div>