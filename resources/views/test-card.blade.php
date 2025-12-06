{{-- resources/views/test-card.blade.php --}}
<x-app-layout>
    <section class="min-h-screen bg-warm flex items-center justify-center">
        <div class="max-w-sm w-full">
            <x-cart
                :product="$product"
                :is-wished="false"
                type="grid"
                :spotlight="false"
                :image-only="false"
            />
        </div>
    </section>
</x-app-layout>
