<?php

class UserController extends Controller
{
    public function index(): void
    {
        $this->requireRole(['Admin']);

        $userModel = new User();
        $users     = $userModel->all();

        $this->view('users/index', [
            'users' => $users,
            'user'  => $_SESSION['user']
        ]);
    }

    public function edit(): void
    {
        $this->requireRole(['Admin']);
        $userModel = new User();
        $id        = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = $_POST['fullname'];
            $username = $_POST['username'];
            $role     = $_POST['role'];


        } else {
            $editUser = $userModel->find($id);
            $this->view('users/edit', [
                'editUser' => $editUser,
                'user'     => $_SESSION['user']
            ]);
        }
    }

    public function delete(): void
    {
        $this->requireRole(['Admin']);
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id) {
            $userModel = new User();
            $userModel->delete($id);
        }
        $this->redirect('/?controller=user&action=index');
    }
}
