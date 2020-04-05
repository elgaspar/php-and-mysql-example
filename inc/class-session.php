<?php

declare(strict_types=1);


class Session
{

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
