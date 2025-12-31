<h2>Suppliers</h2>

<a href="<?= BASE_URL ?>/?controller=supplier&action=create">Add Supplier</a>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($suppliers as $s): ?>
        <tr>
            <td><?= (int)$s['supplier_id'] ?></td>
            <td><?= htmlspecialchars($s['supplier_name']) ?></td>
            <td><?= htmlspecialchars($s['contact_number']) ?></td>
            <td><?= htmlspecialchars($s['address']) ?></td>
            <td>
                <a href="<?= BASE_URL ?>/?controller=supplier&action=edit&id=<?= (int)$s['supplier_id'] ?>">Edit</a> |
                <a href="<?= BASE_URL ?>/?controller=supplier&action=delete&id=<?= (int)$s['supplier_id'] ?>" onclick="return confirm('Delete supplier?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
