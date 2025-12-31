<?php

class Product
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function allWithSupplier(): array
    {
        $sql = "SELECT p.*, s.supplier_name
                FROM products p
                LEFT JOIN suppliers s ON p.supplier_id = s.supplier_id";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function create(
        string $name,
        string $barcode,
        ?string $category,
        float $price,
        int $stock,
        ?int $supplierId
    ): bool {
        $stmt = $this->db->prepare(
            "INSERT INTO products (product_name, barcode, category, price, stock_quantity, supplier_id)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            'sssdii',
            $name,
            $barcode,
            $category,
            $price,
            $stock,
            $supplierId
        );
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(
        int $id,
        string $name,
        string $barcode,
        ?string $category,
        float $price,
        int $stock,
        ?int $supplierId
    ): bool {
        $stmt = $this->db->prepare(
            "UPDATE products SET product_name=?, barcode=?, category=?, price=?, stock_quantity=?, supplier_id=?
             WHERE product_id=?"
        );
        $stmt->bind_param('sssdisi', $name, $barcode, $category, $price, $stock, $supplierId, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE product_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function adjustStock(int $productId, int $delta): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE products
             SET stock_quantity = stock_quantity + ?
             WHERE product_id = ?"
        );
        $stmt->bind_param('ii', $delta, $productId);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function searchByNameOrBarcode(string $term): array
    {
        $like = '%' . $term . '%';
        $stmt = $this->db->prepare(
            "SELECT * FROM products WHERE product_name LIKE ? OR barcode LIKE ?"
        );
        $stmt->bind_param('ss', $like, $like);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }
}
