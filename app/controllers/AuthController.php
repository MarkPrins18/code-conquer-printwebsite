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

        view('auth/register', ['formHandlingTranslations' => $formHandlingTranslations,
                               'errors'                   => $errors,
                               'old'                      => $old
        ]);
    }


    public function handleRegister(): void {

        if (isset($_POST['submit'])) {
            $user = new User(
                trim($_POST['company_name'] ?? ''),
                trim($_POST['email']        ?? ''),
                     $_POST['password']     ?? '',
                     $_POST['confirm']      ?? ''
            );

        
            $errors = $user->validateRegister();

        // Check the terms acceptance
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

        // Direct login after registration
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

        $errors  = Session::getFlash('errors',  []);
        $old     = Session::getFlash('old',     []);
        $success = Session::getFlash('success', '');

        global $formHandlingTranslations;
        
        view('auth/login', ['formHandlingTranslations' => $formHandlingTranslations,
                            'errors'                   => $errors,
                            'old'                      => $old,
                            'success'                  => $success
        ]);
    }

    

    public function handleLogin(): void {

        $email    = trim($_POST['email']    ?? '');
        $password = $_POST['password']      ?? '';

        $userModel = new User('', '', '', '');

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
            // Error message for invalid credentials (without further information)
            Session::flash('errors', ['credentials' => 'err_login']);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->startUserSession($found);

        
        if ($_SESSION['role_name'] === 'Admin') {
            header('Location: ' . BASE_URL . '/admin');
        } else {
            header('Location: ' . BASE_URL . '/');
        }
            exit;
    }


    public function logout(): void
    {
        Session::destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }


    public function showForgotPassword(): void {
        // Show form to reset password
        if (Session::isLoggedIn()) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }

        global $formHandlingTranslations;

        // Read all flash values
        $errors    = Session::getFlash('errors',     []);
        $old       = Session::getFlash('old',        []);
        $success   = Session::getFlash('success',    '');
        $resetLink = Session::getFlash('reset_link', '');

        view('auth/forgot-password', ['formHandlingTranslations' => $formHandlingTranslations,
                                      'errors'                   => $errors,
                                      'old'                      => $old,
                                      'success'                  => $success,
                                      'resetLink'                => $resetLink,
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
            $token = $userModel->createResetToken($email);

            if ($token) {
                $resetLink = BASE_URL
                    . '/reset-password?token=' . urlencode($token)
                    . '&email='                . urlencode($email);

                Session::flash('reset_link', $resetLink);
                error_log('RESET LINK: ' . $resetLink);
            }

        } catch (Exception $e) {
            error_log('Forgot-password fout: ' . $e->getMessage());
            Session::flash('errors', ['technical' => 'err_technical']);
            Session::flash('old', ['email' => $email]);
            header('Location: ' . BASE_URL . '/forgot-password');
            exit;
        }

        
        Session::flash('success', 'msg_reset_sent');
        header('Location: ' . BASE_URL . '/forgot-password');
        exit;

   }

    public function showResetPassword(): void {

        $token = $_GET['token'] ?? '';
        $email = $_GET['email'] ?? '';

        if ($token === '') {
            header('Location: ' . BASE_URL . '/forgot-password');
            exit;
        }

        global $formHandlingTranslations;

       $errors = Session::getFlash('errors', []); 

    view('auth/reset-password',['formHandlingTranslations' => $formHandlingTranslations,
                                                  'errors' => $errors ?? [],
                                                   'token' => $token  ?? '',
                                                   'email' => $email  ?? '',
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

        // Check token + password in one go
        $errors = $userModel->validateResetPassword($email, $token, $password, $confirm);

        if (!empty($errors)) {
            Session::flash('errors', $errors);
            header('Location: ' . BASE_URL
                . '/reset-password?token=' . urlencode($token)
                . '&email='               . urlencode($email));
            exit;
        }

        try {
            // Get token for user_id and token_id
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

        // Password changed → redirect to login with success message
        Session::flash('success', 'msg_reset_success');
        header('Location: ' . BASE_URL . '/login');
        exit;
    }


    //   Set session variables after a successful login or registration.
    //   session_regenerate_id() prevents session fixation attacks.

    private function startUserSession(array $user): void
    {
        session_regenerate_id(true);
         // Set session data AFTER regeneration
        $_SESSION['user_id']   = $user['user_id'];
        $_SESSION['role_name'] = ($user['role_code'] ?? '') === 'ADMIN' ? 'Admin' : 'User';
    }
}


