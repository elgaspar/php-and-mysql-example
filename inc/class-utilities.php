<?php

declare(strict_types=1);

require_once 'class-database.php';


class Utilities
{
    const CONFIG_FILE = 'config.ini';


    public static function get_config()
    {
        return parse_ini_file(self::CONFIG_FILE);
    }

    public static function user_login(string $email, string $password): ?User
    {
        $user = Database::get_user_by_email($email);
        if ($user && password_verify($password, $user->get_password_hash())) {
            return $user;
        } else {
            return null;
        }
    }

    //Returns error msg on failure, or null on success
    public static function review_application(Application $application, bool $approve, string $token): ?string
    {
        if (!$application) {
            return 'Invalid application ID.';
        }

        if ($approve) {
            $succeed = $application->approve($token);
        } else {
            $succeed = $application->reject($token);
        }

        if (!$succeed) {
            return 'Invalid token.';
        }

        Database::update_application($application);
        return null;
    }
}
