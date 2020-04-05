<?php

declare(strict_types=1);


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
        $this->id = $data['id'] ?? -1;
        $this->first_name = $data['first_name'] ?? '';
        $this->last_name = $data['last_name'] ?? '';
        $this->email = $data['email'] ?? '';
        $this->password_hash = $data['password_hash'] ?? '';
        $this->is_admin = $data['is_admin'] ? true : false;
    }

    public function get_id(): int
    {
        return $this->id;
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
}
