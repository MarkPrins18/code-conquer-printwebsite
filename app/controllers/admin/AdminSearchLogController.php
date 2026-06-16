<?php

class AdminSearchLogController
{

    public function index(): void
    {
        AuthGuard::requireAdmin();

        $pdo      = Database::getConnection();
        $model    = new SearchLog($pdo);
        $searchlogs = $model->getAll();

        view('admin/searchlogs/index', ['searchlogs' => $searchlogs]);
    }


    public function deleteLogs()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['selected_ids'])) {
            $pdo      = Database::getConnection();
            $searchLogModel = new SearchLog($pdo);

            $searchLogModel->delete($_POST['selected_ids']);
        }

        header('Location: /admin/searchlogs');
        exit();
    }
}
