<h2>User List</h2>

<p>
    <a href="<?= BASE_URL ?>/?controller=auth&action=register">Register New User</a>
</p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= (int)$u['user_id'] ?></td>
            <td><?= htmlspecialchars($u['full_name']) ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['role']) ?></td>
            <td>
                  <a href="<?= BASE_URL ?>/?controller=user&action=edit&id=<?= (int)$u['user_id'] ?>">Edit</a> |
                <a href="<?= BASE_URL ?>/?controller=user&action=delete&id=<?= (int)$u['user_id'] ?>" onclick="return confirm('Delete user?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
