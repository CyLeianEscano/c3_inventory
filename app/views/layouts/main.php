<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>c3_inventory</title>
    <link rel="stylesheet" href="/wwwroot/css/site.css">
    <script src="/wwwroot/js/site.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<?php

function is_active(string $controller): string {
    $curController = $_GET['controller'] ?? 'dashboard';
    return $curController === $controller ? 'active' : '';
}

function is_active_action(string $controller, string $action): string {
    $curController = $_GET['controller'] ?? 'dashboard';
    $curAction     = $_GET['action'] ?? 'index';
    return ($curController === $controller && $curAction === $action) ? 'active' : '';
}
?>

<div class="app-layout">
    <?php if (isset($_SESSION['user'])): ?>
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>
                    <span class="sidebar-title-main">Inventory</span><br>
                    <span class="sidebar-title-sub">Management Dashboard</span>
                </h1>
                <hr>
            </div>

           <nav class="sidebar-nav">
                <a class="<?= is_active('dashboard') ?>"
                   href="<?= BASE_URL ?>/?controller=dashboard&action=index">Dashboard</a>

                <a class="<?= is_active('product') ?>"
                   href="<?= BASE_URL ?>/?controller=product&action=index">Products</a>

                <?php if ($_SESSION['user']['role'] === 'Cashier'): ?>
                    <a class="<?= is_active('cashier') ?>"
                       href="<?= BASE_URL ?>/?controller=cashier&action=cart">Cashier</a>
                <?php endif; ?>

<?php if (in_array($_SESSION['user']['role'], ['Staff', 'Admin'])): ?>
    <a class="<?= is_active_action('staff', 'inventory') ?>"
       href="<?= BASE_URL ?>/?controller=staff&action=inventory">Inventory</a>
    <a class="<?= is_active_action('staff', 'transactions') ?>"
       href="<?= BASE_URL ?>/?controller=staff&action=transactions">Transactions</a>
<?php endif; ?>

               <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                    <a class="<?= is_active('user') ?>"
                       href="<?= BASE_URL ?>/?controller=user&action=index">Users</a>
                <?php endif; ?>
            </nav>

            <div class="sidebar-user">
                <div class="sidebar-username">
                    <?= htmlspecialchars($_SESSION['user']['fullName'] ?? $_SESSION['user']['username']) ?>
                </div>
                <div class="sidebar-role">
                    (<?= htmlspecialchars($_SESSION['user']['role']) ?>)
                </div>
                <div class="sidebar-logout">
                    <a href="<?= BASE_URL ?>/?controller=auth&action=logout">Logout</a>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <?= $content ?>
        </main>
    <?php else: ?>
        <main class="main-content full-width">
            <?= $content ?>
        </main>
    <?php endif; ?>
</div>
</body>
</html>
