<div class="fi-ta-ctn relative overflow-x-auto shadow-sm rounded-lg bg-white dark:bg-gray-900">
    <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
        <div class="flex justify-end gap-4">
            <span class="font-semibold text-gray-900 dark:text-gray-100">Total:</span>
            <span class="font-semibold text-lg text-gray-900 dark:text-gray-100 min-w-24">
                {{ $quotationItemsTotal ?? '0.00' }}
            </span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Watch for table updates and recalculate total
        const tableContainer = document.querySelector('[data-table-resource="quotationitems"]');
        if (tableContainer) {
            const observer = new MutationObserver(function(mutations) {
                // Recalculate total when table changes
                const totalElement = document.querySelector('[data-quotation-total]');
                if (totalElement) {
                    const totals = Array.from(
                        document.querySelectorAll('table tbody tr:not(:last-child) td:last-child')
                    ).map(el => parseFloat(el.textContent) || 0);
                    
                    const sum = totals.reduce((a, b) => a + b, 0);
                    totalElement.textContent = sum.toFixed(2);
                }
            });
            
            observer.observe(tableContainer, {
                childList: true,
                subtree: true,
                characterData: true
            });
        }
    });
</script>
