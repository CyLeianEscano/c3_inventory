<?php

class ProductController extends Controller
{
    public function index(): void
    {
        $this->requireRole(['Admin', 'Staff', 'Cashier']);

        $productModel  = new Product();
        $products      = $productModel->allWithSupplier();

        $this->view('products/index', [
            'user'     => $_SESSION['user'],
            'products' => $products
        ]);
    }

    public function create(): void
    {
        $this->requireRole(['Admin', 'Staff']);

        $supplierModel = new Supplier();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name       = $_POST['product_name'];
            $barcode    = $_POST['barcode'];
            $category   = $_POST['category'] ?? null;
            $price      = (float)$_POST['price'];
            $stock      = (int)$_POST['stock_quantity'];
            $supplierId = !empty($_POST['supplier_id']) ? (int)$_POST['supplier_id'] : null;

            $productModel = new Product();
            $productModel->create($name, $barcode, $category, $price, $stock, $supplierId);

            $this->redirect('/?controller=product&action=index');
        } else {
            $suppliers = $supplierModel->all();
            $this->view('products/create', ['suppliers' => $suppliers, 'user' => $_SESSION['user']]);
        }
    }

    public function edit(): void
    {
        $this->requireRole(['Admin', 'Staff']);

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if (!$id) {
            die('No product selected');
        }

        $productModel  = new Product();
        $supplierModel = new Supplier();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name       = $_POST['product_name'];
            $barcode    = $_POST['barcode'];
            $category   = $_POST['category'] ?? null;
            $price      = (float)$_POST['price'];
            $stock      = (int)$_POST['stock_quantity'];
            $supplierId = !empty($_POST['supplier_id']) ? (int)$_POST['supplier_id'] : null;

            $productModel->update($id, $name, $barcode, $category, $price, $stock, $supplierId);
            $this->redirect('/?controller=product&action=index');
        } else {
            $product   = $productModel->find($id);
            $suppliers = $supplierModel->all();
            $this->view('products/edit', [
                'product'   => $product,
                'suppliers' => $suppliers,
                'user'      => $_SESSION['user']
            ]);
        }
    }

    public function delete(): void
    {
        $this->requireRole(['Admin']);

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id) {
            $productModel = new Product();
            $productModel->delete($id);
        }
        $this->redirect('/?controller=product&action=index');
    }
}
