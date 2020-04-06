<?php

declare(strict_types=1);

require_once 'inc/enum-user-type.php';


class User
{
    private int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password_hash;
    private bool $is_admin;


    public function __construct(array $data)
    {
        $this->id = -1;
        $this->first_name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password_hash = '';
        $this->is_admin = false;

        $this->set_data_array($data);
    }


    public function get_data_array(): array
    {
        return array(
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password_hash' => $this->password_hash,
            'is_admin' => $this->is_admin
        );
    }

    public function set_data_array(array $data): void
    {
        $this->id = $data['id'] ?? $this->id;
        $this->first_name = $data['first_name'] ?? $this->first_name;
        $this->last_name = $data['last_name'] ?? $this->last_name;
        $this->email = $data['email'] ?? $this->email;
        $this->password_hash = $data['password_hash'] ?? $this->password_hash;
        if (isset($data['is_admin'])) {
            $this->is_admin = $data['is_admin'] ? true : false;
        }
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function set_id(int $new_id): void
    {
        $this->id = $new_id;
    }

    public function get_first_name(): string
    {
        return $this->first_name;
    }

    public function get_last_name(): string
    {
        return $this->last_name;
    }

    public function get_email(): string
    {
        return $this->email;
    }

    public function get_password_hash(): string
    {
        return $this->password_hash;
    }

    public function is_admin(): bool
    {
        return $this->is_admin;
    }

    public function get_user_type(): string
    {
        if ($this->is_admin()) {
            return UserType::ADMIN;
        }
        return UserType::EMPLOYEE;
    }
}
