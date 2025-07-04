<x-filament-panels::page>

    <div class="flex flex-col md:flex-row gap-2">
        
        <div class="w-full md:w-1/3 md:order-2">
            <livewire:product-search />
        </div>

        <div class="w-full md:w-2/3 md:order-1">
            <div class="flex flex-col md:flex-row gap-4 pb-4">
                <h1 class="w-full text-white">Nama Customer</h1>
                <div class="w-full md:w-1/2">
                    <livewire:customer-search />
                </div>
            </div>
            <livewire:cart />
        </div>

    </div>

    <livewire:error />

</x-filament-panels::page>
