<h2>Inventory (Staff)</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Barcode</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Supplier</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($products as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['product_name']) ?></td>
            <td class="barcode-text">
                   <span class="barcode-bars"><?= htmlspecialchars($p['barcode']) ?></span>
                   <span class="barcode-human"><?= htmlspecialchars($p['barcode']) ?></span>
               </td>
            <td><?= htmlspecialchars($p['category']) ?></td>
            <td><?= (int)$p['stock_quantity'] ?></td>
            <td><?= htmlspecialchars($p['supplier_name'] ?? 'No Supplier') ?></td>
            <td>
                <a href="<?= BASE_URL ?>/?controller=staff&action=restock&id=<?= (int)$p['product_id'] ?>">
                    Restock
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<p>
    <a href="<?= BASE_URL ?>/?controller=staff&action=transactions">View Transactions</a>
</p>
