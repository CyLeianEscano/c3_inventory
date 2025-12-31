<h2>Cashier - Cart</h2>
<a href="<?= BASE_URL ?>/?controller=cashier&action=search">Search Products</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Barcode</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>
    <?php
    $total = 0;
    foreach ($cartItems as $item):
        $subtotal = $item['price'] * $item['cart_qty'];
        $total += $subtotal;
    ?>
        <tr>
            <td><?= htmlspecialchars($item['product_name']) ?></td>
            <td><?= htmlspecialchars($item['barcode']) ?></td>
            <td><?= number_format($item['price'], 2) ?></td>
            <td><?= (int)$item['cart_qty'] ?></td>
            <td><?= number_format($subtotal, 2) ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4">Total</td>
        <td><?= number_format($total, 2) ?></td>
    </tr>
</table>

<?php if (!empty($cartItems)): ?>
    <form method="post" action="<?= BASE_URL ?>/?controller=cashier&action=checkout" style="margin-top:10px;">
        <button type="submit" onclick="return confirm('Confirm checkout?');">Checkout</button>
    </form>
<?php endif; ?>
