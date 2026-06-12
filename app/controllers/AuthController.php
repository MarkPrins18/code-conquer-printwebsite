<?php

class AuthController {
    public function showRegister(): void {
        global $formHandlingTranslations;
        
        view('auth/register', [
            'formHandlingTranslations' => $formHandlingTranslations,
        ]);

        

    }

    public function showLogin(): void {
        global $formHandlingTranslations;
        
        view('auth/login', [
            'formHandlingTranslations' => $formHandlingTranslations,
        ]);
    }

    public function handleRegister(): void {
        if (isset($_POST['submit'])) {
            $user = new User(
                $_POST['company_name'],
                $_POST['email'],
                $_POST['password'],
                $_POST['confirm']
            );
            $user->signupUser();
        }
    }

    public function handleLogin(): void {
        // $user = new User(...);  //gebruiker Object
        // $found = $user->loginUser($_POST['email'], $_POST['password']);
        // if ($found) {
        //     Session::set('user_id', $found['user_id']);
        //     Session::set('role_name', $found['role_label']); // nodig voor isAdmin()
        //     header('Location: ' . BASE_URL . '/orders');
        // } else {
        //     // terug naar het formulier met een foutmelding!
        // }
    }

    public function showForgotPassword(): void {
        // toon formulier om wachtwoord te resetten

    // Later:
    // User::createResetToken()
    // Mail versturen
        global $formHandlingTranslations;
        
        view('auth/forgot-password', [
            'formHandlingTranslations' => $formHandlingTranslations,
        ]);
    }


    public function handleForgotPassword(): void {
    $email = trim($_POST['email']);

    $userModel = new User('', '', '', '');

    $token = $userModel->createResetToken(
        $email
    );
 // Logica voor het aanmaken van een reset-token en versturen van de e-mail
 
    if ($token) { $resetLink = BASE_URL .
    '/reset-password?' .
    'token=' . urlencode($token) .
    '&email=' . urlencode($email);

        // tijdelijke PoC
        error_log(
            'RESET LINK: ' . $resetLink
        );
    }

        global $formHandlingTranslations, $lang;
    view(
        'auth/forgot-password',
        [
            'formHandlingTranslations' => $formHandlingTranslations,
            'lang' => $lang,
            'success' =>
                $formHandlingTranslations[$lang]['msg_reset_sent']
        ]
    );
}
           
     

    public function showResetPassword(): void {
        // Logica voor het resetten van het wachtwoord

    $token = $_GET['token'] ?? '';
    $email = $_GET['email'] ?? '';

    if (!$token) {

        header(
            'Location: ' .
            BASE_URL .
            '/forgot-password'
        );

        exit;
    }

    $userModel = new User('', '', '', '');

    $tokenRow =
        $userModel->validateResetToken(
            $email,
            $token
        );

        global $formHandlingTranslations;

    view(
        'auth/reset-password',
        [
            'formHandlingTranslations'
                => $formHandlingTranslations,

            'token'
                => $token,

            'email'
                => $email,

            'tokenRow'
                => $tokenRow
        ]
    );
}


    public function handleResetPassword(): void {
    $token = $_POST['token'] ?? '';
    $email = trim($_POST['email'] ?? '');

    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        return;
    }

    $userModel = new User('', '', '', '');

    $tokenRow = $userModel->validateResetToken(
        $email,
        $token 
    );

    if (!$tokenRow) {
        return;
    }

    $userModel->resetPassword(
        $tokenRow['user_id'],
        $password
    );

    $userModel->deleteResetToken(
        $tokenRow['token_id']
    );

    header(
        'Location: ' .
        BASE_URL .
        '/login'
    );

    exit;
    }
           
}