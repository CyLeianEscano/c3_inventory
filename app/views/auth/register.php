<h2>Register User</h2>
<form method="post" action="<?= BASE_URL ?>/?controller=auth&action=register">
    <label>Full Name
        <input type="text" name="fullname" required>
    </label><br>
    <label>Username
        <input type="text" name="username" required>
    </label><br>
    <label>Password
        <input type="password" name="password" required>
    </label><br>
    <label>Role
        <select name="role" required>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
            <option value="Cashier">Cashier</option>
        </select>
    </label><br>
    <button type="submit">Register</button>
</form>
