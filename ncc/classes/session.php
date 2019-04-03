<?php
class session {
    public static function start() {
        session_start();
    }
    public static function userLogout() {
        session_start();
        $_SESSION['userName'] = '';
        $_SESSION['loggedin'] = FALSE;
        session_destroy();
    }
    public static function isSessionStarted() {
        if(php_sapi_name() !== 'cli') {
            if(version_compare(phpversion(), '5.4.0', '>=')) {
                return session_start() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
            } else {
                return session_id() === '' ? FALSE : TRUE;
            }
        }
        return FALSE;
    }
    public static function login($userName) {
        session_start();
        $_SESSION['userName'] = $userName;
        $_SESSION['loggedin'] = TRUE;
        session_commit();
    }
    public static function isLoggedIn() {
        return isset($_SESSION["loggedin"]);
    }
}
