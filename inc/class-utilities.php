<?php

declare(strict_types=1);

require_once 'class-database.php';


class Utilities
{
    public static function user_login(string $email, string $password): ?User
    {
        $user = Database::get_user_by_email($email);
        if ($user && password_verify($password, $user->get_password_hash())) {
            return $user;
        } else {
            return null;
        }
    }
}
