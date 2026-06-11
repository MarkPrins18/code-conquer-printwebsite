<?php

class DashboardController {
    public function index(): void {
        AuthGuard::requireAdmin();
        view('admin/dashboard');
    }
}
