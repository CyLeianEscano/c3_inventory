<?php

class Transaction
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function create(
        int $productId,
        int $userId,
        string $type,
        int $qty
    ): bool {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare(
            "INSERT INTO transaction (product_id, user_id, transaction_type, quantity, transaction_date)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param('iisis', $productId, $userId, $type, $qty, $now);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function inventoryAnalytics(): array
    {
        $sql = "SELECT category, SUM(stock_quantity) AS total_stock
                FROM products
                GROUP BY category";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function monthlySales(): array
    {
        $year = date('Y');

        $sql = "
            SELECT
                DATE_FORMAT(transaction_date, '%Y-%m') AS ym,
                SUM(quantity) AS total_qty
            FROM transaction
            WHERE transaction_type = 'Sales'
              AND YEAR(transaction_date) = ?
            GROUP BY ym
            ORDER BY ym
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $year);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $rows;
    }

    public function allWithDetails(): array
    {
        $sql = "SELECT t.*, p.product_name, u.username
                FROM transaction t
                JOIN products p ON t.product_id = p.product_id
                JOIN users u    ON t.user_id = u.user_id
                ORDER BY t.transaction_date DESC, t.transaction_id DESC";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
