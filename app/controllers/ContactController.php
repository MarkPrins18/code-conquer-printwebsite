<?php

class ContactController {
    public function index(): void {
        view('guest/contact/index');
    }

    public function send(): void {
        $name = trim($_POST['name'] ?? "");
        $email = trim($_POST['email'] ?? "");
        $message = trim($_POST['message'] ?? "");

        if (!$name || !$email || !$message) {
            view('guest/contact/index', ['error' => 'Vul alle velden in,']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            view('guest/contact/index', ['error' => 'vul een geldig e-mailadres in.']);
            return;
        }

        view('guest/contact/index', [
            'success'      => true,
            'mailPreview'  => [
                'aan'       => 'info@bouw3d.nl',
                'van'       => "$email",
                'onderwerp' => 'Nieuw contactbericht',
                'bericht'   => $message,
            ]
        ]);

    }
}
