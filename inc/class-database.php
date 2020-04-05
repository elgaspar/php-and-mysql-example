<?php

declare(strict_types=1);

require_once 'class-user.php';
require_once 'class-application.php';


class Database
{
    const CONFIG_FILE = 'config.ini';


    public static function get_user(int $id): ?User
    {
        $connection = self::connect();

        $stmt = $connection->prepare("SELECT id, password_hash, first_name, last_name, email, is_admin FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $results = $stmt->get_result();
        $results_array = $results->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (count($results_array)) {
            $user_array = $results_array[0];
            return new User($user_array);
        }
        return null;
    }

    public static function get_user_by_email(string $email): ?User
    {
        $connection = self::connect();
        $query = "SELECT id, password_hash, first_name, last_name, email, is_admin FROM users WHERE email = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $results = $stmt->get_result();
        $results_array = $results->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        if (count($results_array)) {
            $user_array = $results_array[0];
            return new User($user_array);
        }
        return null;
    }

    public static function get_all_users(): array
    {
        $connection = self::connect();
        $query = "SELECT id, password_hash, first_name, last_name, email, is_admin FROM users";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $results = $stmt->get_result();
        $results_array = $results->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        $users = array_map(
            function ($data) {
                return new User($data);
            },
            $results_array
        );
        return $users;
    }

    public static function update_user(User $user): void
    {
        $connection = self::connect();
        $query = "UPDATE users SET first_name=?, last_name=?, email=?, password_hash=?, is_admin=? WHERE id=?";
        $results = $connection->prepare($query);
        $values = $user->get_data_array();
        $results->bind_param(
            "ssssii",
            $values['first_name'],
            $values['last_name'],
            $values['email'],
            $values['password_hash'],
            $values['is_admin'],
            $values['id'],
        );
        $results->execute();
        $results->close();
    }

    public static function add_user(User $user): void
    {
        $connection = self::connect();
        $query = "INSERT INTO users (first_name, last_name, email, password_hash, is_admin) VALUES (?, ?, ?, ?, ?)";
        $results = $connection->prepare($query);
        $values = $user->get_data_array();
        $results->bind_param(
            "ssssi",
            $values['first_name'],
            $values['last_name'],
            $values['email'],
            $values['password_hash'],
            $values['is_admin'],
        );
        $results->execute();
        $results->close();
    }

    public static function get_applications_of_user(int $user_id): array
    {
        $connection = self::connect();
        $query = "SELECT created_on, vacation_start, vacation_end, status FROM applications WHERE user_id = ? ORDER BY created_on DESC";
        $stmt = $connection->prepare($query);
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

    public static function add_application(Application $application): void
    {
        $connection = self::connect();
        $query = "INSERT INTO applications (vacation_start, vacation_end, reason, user_id) VALUES (?, ?, ?, ?)";
        $results = $connection->prepare($query);
        $values = $application->get_data_array();
        $results->bind_param(
            "sssi",
            $values['vacation_start'],
            $values['vacation_end'],
            $values['reason'],
            $values['user_id'],
        );
        $results->execute();
        $results->close();
    }



    private static function connect()
    {
        $config = parse_ini_file(self::CONFIG_FILE);

        $connection = mysqli_connect(
            $config['db_host'],
            $config['db_user'],
            $config['db_password'],
            $config['db_name']
        );

        if (!$connection) {
            echo "Database connection error: " . mysqli_connect_error();
            exit;
        }

        return $connection;
    }
}
