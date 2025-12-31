<?php

class CashierController extends Controller
{
    public function cart(): void
    {
        $this->requireRole(['Cashier']);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = (int)($_POST['product_id'] ?? 0);
            $qty       = (int)($_POST['quantity'] ?? 1);
            if ($productId > 0 && $qty > 0) {
                $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + $qty;
            }
        }

        $productModel = new Product();
        $cartItems    = [];
        foreach ($_SESSION['cart'] as $productId => $qty) {
            $product = $productModel->find((int)$productId);
            if ($product) {
                $product['cart_qty'] = $qty;
                $cartItems[] = $product;
            }
        }

        $this->view('cashier/cart', [
            'user'      => $_SESSION['user'],
            'cartItems' => $cartItems
        ]);
    }

    public function search(): void
    {
        $this->requireRole(['Cashier']);

        $term = $_GET['q'] ?? '';
        $productModel = new Product();
        $results = $term ? $productModel->searchByNameOrBarcode($term) : [];

        $this->view('cashier/search', [
            'user'    => $_SESSION['user'],
            'results' => $results,
            'term'    => $term
        ]);
    }

    public function checkout(): void
    {
        $this->requireRole(['Cashier']);

        if (empty($_SESSION['cart'])) {
            $this->redirect('/?controller=cashier&action=cart');
        }

        $productModel     = new Product();
        $transactionModel = new Transaction();
        $userId           = (int)$_SESSION['user']['id'];

        foreach ($_SESSION['cart'] as $productId => $qty) {
            $productId = (int)$productId;
            $qty       = (int)$qty;
            if ($productId <= 0 || $qty <= 0) {
                continue;
            }

            $transactionModel->create($productId, $userId, 'Sale', $qty);

            $productModel->adjustStock($productId, -$qty);
        }

        $_SESSION['cart'] = [];

        $this->redirect('/?controller=cashier&action=cart');
    }
}
