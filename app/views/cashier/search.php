<h2>Cashier - Search Products</h2>
<form class="cashier-search" method="get" action="<?= BASE_URL ?>/">
    <input type="hidden" name="controller" value="cashier">
    <input type="hidden" name="action" value="search">

    <input type="text"
           name="q"
           value="<?= htmlspecialchars($term) ?>"
           placeholder="Search by name or barcode">

    <div class="cashier-search-actions">
        <button type="submit">Search</button>
    </div>
</form>

<?php if (!empty($results)): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Barcode</th>
            <th>Price</th>
            <th>Add to Cart</th>
        </tr>
        <?php foreach ($results as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['product_name']) ?></td>
                <td class="barcode-text">
                   <span class="barcode-bars"><?= htmlspecialchars($p['barcode']) ?></span>
                   <span class="barcode-human"><?= htmlspecialchars($p['barcode']) ?></span>
               </td>
                <td><?= number_format($p['price'], 2) ?></td>
                <td>
                    <form method="post" action="<?= BASE_URL ?>/?controller=cashier&action=cart">
                        <input type="hidden" name="product_id" value="<?= (int)$p['product_id'] ?>">
                        <input type="number" name="quantity" value="1" min="1" style="width:60px;">
                        <button type="submit">Add</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php elseif (isset($term) && $term !== ''): ?>
    <p style="margin-top:10px; color:#b91c1c; font-weight:bold;">
        No results found for "<?= htmlspecialchars($term) ?>".
    </p>
<?php endif; ?>
