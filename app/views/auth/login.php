<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<div class="login-page">
    <div class="login-card">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <p class="error-message"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="<?= BASE_URL ?>/?controller=auth&action=login">
            <div class="login-field">
                <span class="login-label">Username</span>
                <input type="text" name="username" required>
            </div>
            <div class="login-field">
                <span class="login-label">Password</span>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
