<div class="order-filters">
    <?php if ($showSearch ?? false): ?>
        <input
            type="text"
            id="order-search"
            placeholder="<?= htmlspecialchars($orderOverviewTranslations[$lang]['search_placeholder']) ?>"
            class="order-filter-search"
        />
    <?php endif; ?>
    <select id="order-status-filter" class="order-filter-select">
        <option value=""><?= htmlspecialchars($orderOverviewTranslations[$lang]['filter_all_statuses']) ?></option>
    </select>
    <button id="order-filter-reset" class="button button--small">
        <?= htmlspecialchars($orderOverviewTranslations[$lang]['reset_filters']) ?>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        initOrderFilter({
            statusSelectId: 'order-status-filter',
            resetBtnId:     'order-filter-reset',
            <?php if ($showSearch ?? false): ?>
            searchInputId:   'order-search',
            searchColumnKey: 'bedrijfsnaam',
            <?php endif; ?>
        });
    });
</script>
