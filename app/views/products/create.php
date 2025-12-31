<h2>Add Product</h2>
<form method="post" action="<?= BASE_URL ?>/?controller=product&action=create">
    <label>Product Name
        <input type="text" name="product_name" required>
    </label><br>
    <label>Barcode
        <input type="text" name="barcode" required>
    </label><br>
    <label>Category
        <input type="text" name="category">
    </label><br>
    <label>Price
        <input type="number" step="0.01" name="price" required>
    </label><br>
    <label>Stock Quantity
        <input type="number" name="stock_quantity" required>
    </label><br>
    <label>Supplier
        <select name="supplier_id">
            <option value="">-- Select Supplier --</option>
            <?php foreach ($suppliers as $s): ?>
                <option value="<?= (int)$s['supplier_id'] ?>">
                    <?= htmlspecialchars($s['supplier_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit">Save</button>
</form>
