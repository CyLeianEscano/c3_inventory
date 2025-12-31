<?php

class DashboardController extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            $this->redirect('/?controller=auth&action=login');
        }

        $transactionModel = new Transaction();

        $analytics     = $transactionModel->inventoryAnalytics();
        $monthlySales  = $transactionModel->monthlySales();

        $this->view('dashboard/index', [
            'user'         => $_SESSION['user'],
            'analytics'    => $analytics,
            'monthlySales' => $monthlySales,
        ]);
    }
}
