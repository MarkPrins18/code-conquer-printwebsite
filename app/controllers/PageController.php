<?php

class PageController {
    public function home(): void {
        require_once BASE_PATH . '/app/lang/index-translation.php';
        view('guest/home/index', ['translations' => $translations]);
    }

    public function about(): void {
        view('guest/about/index');
    }

    public function services(): void {
        view('guest/services/index');
    }
}
