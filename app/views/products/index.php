<h2>Product Management</h2>

<?php if (in_array($user['role'], ['Admin', 'Staff'])): ?>
    <a href="<?= BASE_URL ?>/?controller=product&action=create">Add Product</a>
<?php endif; ?>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Barcode</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock Quantity</th>
        <th>Supplier</th>
        <?php if (in_array($user['role'], ['Admin', 'Staff'])): ?>
            <th>Actions</th>
        <?php endif; ?>
    </tr>

    <?php if (!empty($products)): ?>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?= (int)$p['product_id'] ?></td>
                <td><?= htmlspecialchars($p['product_name']) ?></td>
                <td class="barcode-text">
                   <span class="barcode-bars"><?= htmlspecialchars($p['barcode']) ?></span>
                   <span class="barcode-human"><?= htmlspecialchars($p['barcode']) ?></span>
               </td>
                <td><?= htmlspecialchars($p['category']) ?></td>
                <td><?= number_format($p['price'], 2) ?></td>
                <td><?= (int)$p['stock_quantity'] ?></td>
                <td><?= htmlspecialchars($p['supplier_name'] ?? 'No Supplier') ?></td>
                <?php if (in_array($user['role'], ['Admin', 'Staff'])): ?>
                    <td>
                        <a href="<?= BASE_URL ?>/?controller=product&action=edit&id=<?= (int)$p['product_id'] ?>">Edit</a>
                        <?php if ($user['role'] === 'Admin'): ?>
                            | <a href="<?= BASE_URL ?>/?controller=product&action=delete&id=<?= (int)$p['product_id'] ?>" onclick="return confirm('Delete product?');">Delete</a>
                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="8">No products found.</td></tr>
    <?php endif; ?>
</table>
