<?php
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/Database.php';

$db = Database::getConnection();

function setUser($db, $username, $plainPassword, $role, $fullName) {
    $hash = password_hash($plainPassword, PASSWORD_DEFAULT);

    $stmt = $db->prepare(
        "UPDATE users
         SET full_name = ?, role = ?, password = ?
         WHERE username = ?"
    );
    $stmt->bind_param('ssss', $fullName, $role, $hash, $username);
    $stmt->execute();
    echo "Updated user '$username' with password '$plainPassword' as role '$role'\n";
    $stmt->close();
}

setUser($db, '1', '1', 'Cashier', 'Cashier User');
setUser($db, '2', '2', 'Staff',   'Staff User');
setUser($db, '3', '3', 'Admin',   'Admin User');

echo "Done.\n";