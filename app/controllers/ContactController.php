<?php

class ContactController {
    public function index(): void {
        global $contactTranslations;
        view('guest/contact/index', ['translations' => $contactTranslations]);
    }

    public function send(): void {
        $name    = trim($_POST['name']    ?? "");
        $email   = trim($_POST['email']   ?? "");
        $subject = trim($_POST['subject'] ?? "");
        $message = trim($_POST['message'] ?? "");

        if (!$name || !$email || !$subject || !$message) {
            view('guest/contact/index', ['error' => 'Vul alle velden in.']);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            view('guest/contact/index', ['error' => 'Vul een geldig e-mailadres in.']);
            return;
        }

        view('guest/contact/index', [
            'success'     => true,
            'mailPreview' => [
                'aan'       => 'info@bouw3d.nl',
                'van'       => $email,
                'onderwerp' => $subject,
                'bericht'   => $message,
            ]
        ]);
    }
}