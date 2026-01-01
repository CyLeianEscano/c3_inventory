<div class="form-page">
    <div class="form-card">
        <h2>Edit Product</h2>

        <form method="post" action="<?= BASE_URL ?>/?controller=product&action=edit&id=<?= (int)$product['product_id'] ?>">
            <label>Product Name
                <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
            </label><br>
            <label>Barcode
                <input type="text" name="barcode" value="<?= htmlspecialchars($product['barcode']) ?>" required>
            </label><br>
            <label>Category
                <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>">
            </label><br>
            <label>Price
                <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>
            </label><br>
            <label>Stock Quantity
                <input type="number" name="stock_quantity" value="<?= (int)$product['stock_quantity'] ?>" required>
            </label><br>
            <label>Supplier
                <select name="supplier_id">
                    <option value="">-- Select Supplier --</option>
                    <?php foreach ($suppliers as $s): ?>
                        <option value="<?= (int)$s['supplier_id'] ?>"
                            <?= $product['supplier_id'] == $s['supplier_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['supplier_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>
            <button type="submit">Update</button>
        </form>
    </div>
</div>
