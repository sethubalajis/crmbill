<div class="fi-resource-relation-manager">
    {{ $this->content }}

    <!-- Quotation Items Total Footer -->
    <div class="mt-4 px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg">
        <div class="flex justify-end items-center gap-4">
            <span class="font-semibold text-gray-700 dark:text-gray-300">Total:</span>
            <span class="font-bold text-lg text-gray-900 dark:text-gray-100" id="quotation-items-total">
                {{ number_format($this->getOwnerRecord()?->quotationitems()->sum('total') ?? 0, 2) }}
            </span>
        </div>
    </div>

    <x-filament-panels::unsaved-action-changes-alert />
</div>

<script>
    document.addEventListener('livewire:updated', function() {
        // Recalculate total after any Livewire update
        const totalElement = document.getElementById('quotation-items-total');
        if (totalElement) {
            const cells = document.querySelectorAll('table tbody td:last-child:not([data-total-cell="false"])');
            let sum = 0;
            cells.forEach(cell => {
                const value = parseFloat(cell.textContent.trim().replace(/[^\d.-]/g, '')) || 0;
                sum += value;
            });
            totalElement.textContent = sum.toFixed(2);
        }
    });
</script>
