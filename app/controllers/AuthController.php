<?php

class AuthController {
    public function showRegister(): void {

        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        global $formHandlingTranslations;
        
        $errors = Session::getFlash('errors', []);
        $old    = Session::getFlash('old',    []);

        view('auth/register', [
            'formHandlingTranslations' => $formHandlingTranslations,
            'errors'                   => $errors,
            'old'                      => $old
        ]);
    }


    public function handleRegister(): void {
        if (isset($_POST['submit'])) {
            $user = new User(
                trim($_POST['company_name'] ?? ''),
            trim($_POST['email']        ?? ''),
            $_POST['password']          ?? '',
            $_POST['confirm']           ?? ''
        );

        // validateRegister() geeft [veld => vertaalsleutel] terug of []
        $errors = $user->validateRegister();

        // Terms apart controleren — staat niet in User omdat het geen DB-veld is
        if (empty($_POST['terms'])) {
            $errors['terms'] = 'err_terms';
        }

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', [
                'company_name' => $_POST['company_name'] ?? '',
                'email'        => $_POST['email']        ?? '',
            ]);
            header('Location: ' . BASE_URL . '/register');
            exit;
        }

        try {
            $errors = $user->signupUser();
        } catch (Exception $e) {
            error_log('Registratie mislukt: ' . $e->getMessage());
            Session::flash('errors', ['technical' => 'err_technical']);
            Session::flash('old', [
                'company_name' => $_POST['company_name'] ?? '',
                'email'        => $_POST['email']        ?? '',
            ]);
            header('Location: ' . BASE_URL . '/register');
            exit;
        }

        // Direct inloggen na registratie
        $newUser = (new User('', '', '', ''))->findByEmail(trim($_POST['email']));
        if ($newUser) {
            $this->startUserSession($newUser);
        }

        header('Location: ' . BASE_URL . '/');
        exit;
        }
    }

    
    public function showLogin(): void
    {
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        global $formHandlingTranslations;

        $errors  = Session::getFlash('errors',  []);
        $old     = Session::getFlash('old',     []);
        $success = Session::getFlash('success', '');
        global $formHandlingTranslations;
        
        view('auth/login', [
            'formHandlingTranslations' => $formHandlingTranslations,
            'errors'                   => $errors,
            'old'                      => $old,
            'success'                  => $success
        ]);
    }

    

    public function handleLogin(): void {

        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';

        $userModel = new User('', '', '', '');

        // Formaat-validatie eerst (geen DB)
        $errors = $userModel->validateLogin($email, $password);

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        try {
            $found = $userModel->loginUser($email, $password);
        } catch (Exception $e) {
            error_log('Login DB-fout: ' . $e->getMessage());
            Session::flash('errors', ['technical' => 'err_technical']);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        if (!$found) {
            // Bewust vage melding — nooit zeggen of e-mail of wachtwoord fout is
            Session::flash('errors', ['credentials' => 'err_login']);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->startUserSession($found);
        header('Location: ' . BASE_URL . '/');
        exit;
    }

    // ── Uitloggen ─────────────────────────────────────────────────────────────

    public function logout(): void
    {
        Session::destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }


    public function showForgotPassword(): void {
        // toon formulier om wachtwoord te resetten
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }
    
        global $formHandlingTranslations;
       
        $errors  = Session::getFlash('errors',  []);
        $old     = Session::getFlash('old',     []);
        $success = Session::getFlash('success', '');

        view('auth/forgot-password', [
            'formHandlingTranslations' => $formHandlingTranslations,
            'errors'                   => $errors,
            'old'                      => $old,
            'success'                  => $success
        ]);
    }


    public function handleForgotPassword(): void {

    $email = trim($_POST['email'] ?? '');

        $userModel = new User('', '', '', '');
        $errors    = $userModel->validateForgotPassword($email);

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/forgot-password');
            exit;
        }

        try {
            // createResetToken() geeft null terug als e-mail niet bestaat —
            // de controller doet daar niets mee: altijd dezelfde succesboodschap
            $token = $userModel->createResetToken($email);

            if ($token) {
                $resetLink = BASE_URL
                    . '/reset-password?token=' . urlencode($token)
                    . '&email='                . urlencode($email);

                // TODO: vervang door echte Mailer::send($email, $resetLink)
                error_log('RESET LINK: ' . $resetLink);
            }
        } catch (Exception $e) {
            error_log('Forgot-password fout: ' . $e->getMessage());
            Session::flash('errors', ['technical' => 'err_technical']);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/forgot-password');
            exit;
        }

        // Altijd succesboodschap tonen — ook als e-mail niet bestaat
        Session::flash('success', 'msg_reset_sent');
        header('Location: ' . BASE_URL . '/forgot-password');
        exit;

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

        if ($token === '') {
            header('Location: ' . BASE_URL . '/forgot-password');
            exit;
        }

        global $formHandlingTranslations;

       $errors = Session::getFlash('errors', []); 

    view(
        'auth/reset-password',
        [
            'formHandlingTranslations'
                => $formHandlingTranslations,
            'errors'
                => $errors ?? [],

            'token'
                => $token  ?? '',

            'email'
                => $email  ?? '',
        ]
    );
}


    public function handleResetPassword(): void {
        
    $token    = $_POST['token']            ?? '';
        $email    = trim($_POST['email']       ?? '');
        $password = $_POST['password']         ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if ($token === '') {
            header('Location: ' . BASE_URL . '/forgot-password');
            exit;
        }

        $userModel = new User('', '', '', '');

        // validateResetPassword() controleert token + wachtwoord in één keer
        $errors = $userModel->validateResetPassword($email, $token, $password, $confirm);

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            header('Location: ' . BASE_URL
                . '/reset-password?token=' . urlencode($token)
                . '&email='               . urlencode($email));
            exit;
        }

        try {
            // Token ophalen voor user_id en token_id
            $tokenRow = $userModel->validateResetToken($email, $token);

            $userModel->resetPassword($tokenRow['user_id'], $password);
            $userModel->deleteResetToken($tokenRow['token_id']);
        } catch (Exception $e) {
            error_log('Reset-password fout: ' . $e->getMessage());
            Session::flash('errors', ['technical' => 'err_technical']);
            header('Location: ' . BASE_URL
                . '/reset-password?token=' . urlencode($token)
                . '&email='               . urlencode($email));
            exit;
        }

        // Wachtwoord gewijzigd → naar login met succesboodschap
        Session::flash('success', 'msg_reset_success');
        header('Location: ' . BASE_URL . '/login');
        exit;
    }

    // ── Privé hulpfunctie ─────────────────────────────────────────────────────

    /**
     * Zet de sessievariabelen na een succesvolle login of registratie.
     * session_regenerate_id() voorkomt session-fixation aanvallen.
     */
    private function startUserSession(array $user): void
    {
        session_regenerate_id(true);
        Session::set('user_id',   $user['user_id']);
        Session::set('role_name', ($user['role_label'] ?? '') === 'Admin' ? 'Admin' : 'User');
    }
}


