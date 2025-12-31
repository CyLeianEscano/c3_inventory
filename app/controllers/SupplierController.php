<?php

class SupplierController extends Controller
{
    public function index(): void
    {
        $this->requireRole(['Admin', 'Staff']);

        $supplierModel = new Supplier();
        $suppliers     = $supplierModel->all();

        $this->view('suppliers/index', [
            'suppliers' => $suppliers,
            'user'      => $_SESSION['user']
        ]);
    }

    public function create(): void
    {
        $this->requireRole(['Admin', 'Staff']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = $_POST['supplier_name'];
            $contact = $_POST['contact_number'] ?? null;
            $address = $_POST['address'] ?? null;

            $supplierModel = new Supplier();
            $supplierModel->create($name, $contact, $address);

            $this->redirect('/?controller=supplier&action=index');
        } else {
            $this->view('suppliers/create', ['user' => $_SESSION['user']]);
        }
    }

    public function edit(): void
    {
        $this->requireRole(['Admin', 'Staff']);

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $supplierModel = new Supplier();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name    = $_POST['supplier_name'];
            $contact = $_POST['contact_number'] ?? null;
            $address = $_POST['address'] ?? null;

            $supplierModel->update($id, $name, $contact, $address);
            $this->redirect('/?controller=supplier&action=index');
        } else {
            $supplier = $supplierModel->find($id);
            $this->view('suppliers/edit', [
                'supplier' => $supplier,
                'user'     => $_SESSION['user']
            ]);
        }
    }

    public function delete(): void
    {
        $this->requireRole(['Admin']);

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id) {
            $supplierModel = new Supplier();
            $supplierModel->delete($id);
        }
        $this->redirect('/?controller=supplier&action=index');
    }
}
