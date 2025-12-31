<?php

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);
        $viewPath = __DIR__ . '/../views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            die("View not found: $viewPath");
        }

        ob_start();
        include $viewPath;
        $content = ob_get_clean();

        include __DIR__ . '/../views/layouts/main.php';
    }

    protected function redirect(string $path): void
    {
        header("Location: " . BASE_URL . $path);
        exit;
    }

    protected function requireRole(array $roles): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/?controller=auth&action=login');
        }
        if (!in_array($_SESSION['user']['role'], $roles)) {
            http_response_code(403);
            die('Access denied');
        }
    }
}
