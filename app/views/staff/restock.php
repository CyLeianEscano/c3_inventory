<h2>Restock Product</h2>

<p>
    Product: <strong><?= htmlspecialchars($product['product_name']) ?></strong><br>
    Current Stock: <strong><?= (int)$product['stock_quantity'] ?></strong>
</p>

<form method="post" action="<?= BASE_URL ?>/?controller=staff&action=restock&id=<?= (int)$product['product_id'] ?>">
    <label>Quantity to add
        <input type="number" name="quantity" min="1" required>
    </label><br><br>
    <button type="submit">Restock</button>
    <a href="<?= BASE_URL ?>/?controller=staff&action=inventory">Cancel</a>
</form>