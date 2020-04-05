<?php

declare(strict_types=1);

require_once 'class-user.php';
require_once 'class-application.php';


class Database
{
    const CONFIG_FILE = 'config.ini';


    public static function get_user(string $email): ?User
    {
        $connection = self::connect();

        $stmt = $connection->prepare("SELECT id, password_hash, first_name, last_name, is_admin FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $results = $stmt->get_result();
        $results_array = $results->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (count($results_array)) {
            $user_array = $results_array[0];
            $user_array['email'] = $email;
            return new User($user_array);
        }
        return null;
    }

    public static function get_all_applications()
    {
        //TODO
    }

    public static function get_applications_of_user(int $user_id)
    {
        $connection = self::connect();

        $stmt = $connection->prepare("SELECT created_on, vacation_start, vacation_end, status FROM applications WHERE user_id = ? ORDER BY created_on DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $results = $stmt->get_result();
        $applications_array = $results->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $applications = array_map(
            function ($data) {
                return new Application($data);
            },
            $applications_array
        );
        return $applications;
    }

    public static function add_application(Application $application)
    {
        $connection = self::connect();

        $results = $connection->prepare("INSERT INTO applications (vacation_start, vacation_end, reason, user_id) VALUES (?, ?, ?, ?)");
        $results->bind_param("sssi", $application->get_vacation_start(), $application->get_vacation_end(), $application->get_reason(), $application->get_user_id());
        $results->execute();
        $results->close();
    }



    private static function connect()
    {
        $config = parse_ini_file(self::CONFIG_FILE);

        $connection = mysqli_connect($config['db_host'], $config['db_user'], $config['db_password'], $config['db_name']);

        if (!$connection) {
            echo "Database connection error: " . mysqli_connect_error();
            exit;
        }

        return $connection;
    }
}
