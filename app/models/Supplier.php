<?php

class Supplier
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function all(): array
    {
        $result = $this->db->query("SELECT * FROM suppliers");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE supplier_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function create(string $name, ?string $contact, ?string $address): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO suppliers (supplier_name, contact_number, address) VALUES (?, ?, ?)"
        );
        $stmt->bind_param('sss', $name, $contact, $address);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function update(int $id, string $name, ?string $contact, ?string $address): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE suppliers SET supplier_name=?, contact_number=?, address=? WHERE supplier_id=?"
        );
        $stmt->bind_param('sssi', $name, $contact, $address, $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM suppliers WHERE supplier_id=?");
        $stmt->bind_param('i', $id);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }
}
