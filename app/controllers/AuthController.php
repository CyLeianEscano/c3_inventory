<?php

class AuthController extends Controller
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';


            $userModel = new User();
            $user = $userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id'       => $user['user_id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                    'fullName' => $user['full_name']
                ];
                $this->redirect('/?controller=dashboard&action=index');
            } else {
                $this->view('auth/login', ['error' => 'Invalid credentials']);
            }
        } else {
            $this->view('auth/login');
            
        }
    }

    public function register(): void
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'Admin') {
            $this->redirect('/?controller=auth&action=login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = $_POST['fullname'] ?? '';
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $role     = $_POST['role'] ?? 'Staff';

            $userModel = new User();
            $userModel->create($fullName, $username, $password, $role);
            $this->redirect('/?controller=user&action=index');
        } else {
            $this->view('auth/register');
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        $this->redirect('/?controller=auth&action=login');
    }
}
