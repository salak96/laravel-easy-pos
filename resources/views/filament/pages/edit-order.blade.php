<x-filament-panels::page>
    <div class="flex gap-2">
        <div class="w-2/3">
            <div class="flex gap-4  pb-4">
                <div class="w-1/2"> 
                    <livewire:order.barcode-scan :order-id="$this->record->id" />
                </div>
                <div class="w-1/2">
                    <livewire:order.customer-search :order-id="$this->record->id" />
                </div>
            </div>

            <livewire:order.cart :order-id="$this->record->id" />
        </div>
        <div class="w-1/3">
            <livewire:order.product-search :order-id="$this->record->id" />
        </div>
    </div>    
</x-filament-panels::page>
