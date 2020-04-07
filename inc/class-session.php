<?php

declare(strict_types=1);


class Session
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function destroy(): void
    {
        $_SESSION = array();
        session_destroy();
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set_logged_in_user(User $user): void
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['id'] = $user->get_id();
        $_SESSION['email'] = $user->get_email();
        $_SESSION['first_name'] = $user->get_first_name();
        $_SESSION['last_name'] = $user->get_last_name();
        $_SESSION['is_admin'] = $user->is_admin();
    }

    public static function is_logged_in(): bool
    {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;
    }

    public static function is_admin(): bool
    {
        return self::is_logged_in() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true;
    }

    public static function is_employee(): bool
    {
        return self::is_logged_in() && isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == false;
    }
}
