<x-filament-panels::page>
    <div class="flex gap-2">
        <div class="w-2/3">
            <div class="flex gap-4  pb-4">
                <div class="w-1/2">
                    <livewire:barcode-scan />
                </div>
                <div class="w-1/2">
                    <livewire:customer-search />
                </div>
            </div>

            <livewire:cart />
        </div>
        <div class="w-1/3">
            <livewire:product-search />
        </div>
    </div>    
</x-filament-panels::page>
