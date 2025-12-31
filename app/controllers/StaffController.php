<?php

class StaffController extends Controller
{
    public function inventory(): void
    {
        $this->requireRole(['Staff', 'Admin']);

        $productModel = new Product();
        $products     = $productModel->allWithSupplier();

        $this->view('staff/inventory', [
            'user'     => $_SESSION['user'],
            'products' => $products
        ]);
    }

    public function restock(): void
    {
        $this->requireRole(['Staff', 'Admin']);

        $productModel     = new Product();
        $transactionModel = new Transaction();

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            die('Invalid product');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $qty = (int)($_POST['quantity'] ?? 0);
            if ($qty <= 0) {
                die('Quantity must be greater than zero');
            }

            $userId = (int)$_SESSION['user']['id'];

            $transactionModel->create($id, $userId, 'Receipts', $qty);

            $productModel->adjustStock($id, $qty);

            $this->redirect('/?controller=staff&action=inventory');
        } else {
            $product = $productModel->find($id);
            if (!$product) {
                die('Product not found');
            }

            $this->view('staff/restock', [
                'user'    => $_SESSION['user'],
                'product' => $product
            ]);
        }
    }

    public function transactions(): void
    {
        $this->requireRole(['Staff', 'Admin']);

        $transactionModel = new Transaction();
        $transactions     = $transactionModel->allWithDetails();

        $this->view('staff/transactions', [
            'user'         => $_SESSION['user'],
            'transactions' => $transactions
        ]);
    }
}
