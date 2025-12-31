<h2>Edit User</h2>
<form method="post" action="<?= BASE_URL ?>/?controller=user&action=edit&id=<?= (int)$editUser['user_id'] ?>">
    <label>Full Name
        <input type="text" name="fullname" value="<?= htmlspecialchars($editUser['full_name']) ?>" required>
    </label><br>
    <label>Username
        <input type="text" name="username" value="<?= htmlspecialchars($editUser['username']) ?>" required>
    </label><br>
    <label>Role
        <select name="role">
            <option value="Admin" <?= $editUser['role'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
            <option value="Staff" <?= $editUser['role'] === 'Staff' ? 'selected' : '' ?>>Staff</option>
            <option value="Cashier" <?= $editUser['role'] === 'Cashier' ? 'selected' : '' ?>>Cashier</option>
        </select>
    </label><br>
    <button type="submit">Update</button>
</form>
