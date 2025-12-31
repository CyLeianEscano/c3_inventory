<h2>Transaction History</h2>

<table border="1" cellpadding="5">
    <tr>
        <th>Date</th>
        <th>Product</th>
        <th>User</th>
        <th>Type</th>
        <th>Quantity</th>
    </tr>
    <?php foreach ($transactions as $t): ?>
        <tr>
            <td><?= htmlspecialchars($t['transaction_date']) ?></td>
            <td><?= htmlspecialchars($t['product_name']) ?></td>
            <td><?= htmlspecialchars($t['username']) ?></td>
            <td><?= htmlspecialchars($t['transaction_type']) ?></td>
            <td><?= (int)$t['quantity'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>