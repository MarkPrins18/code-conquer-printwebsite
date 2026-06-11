<?php

class ContactController {
    public function index(): void {
        global $contactTranslations;
        view('guest/contact/index', ['translations' => $contactTranslations]);
    }

    public function send(): void {
        global $contactTranslations;
        $name    = trim($_POST['name']    ?? "");
        $email   = trim($_POST['email']   ?? "");
        $subject = trim($_POST['subject'] ?? "");
        $message = trim($_POST['message'] ?? "");

        if (!$name || !$email || !$subject || !$message) {
            view('guest/contact/index', ['translations' => $contactTranslations, 'error' => translate('all_fields_required', $translations, $lang)]);
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            view('guest/contact/index', ['translations' => $contactTranslations, 'error' => translate('invalid_email', $translations, $lang)]);
            return;
        }

        view('guest/contact/index', [
            'translations' => $contactTranslations,
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