<?php

declare(strict_types=1);


class Application
{
    private int $id;
    private string $vacation_start;
    private string $vacation_end;
    private string $reason;
    private int $user_id;
    private string $status;
    private string $created_on;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? -1;
        $this->vacation_start = $data['vacation_start'] ?? '';
        $this->vacation_end = $data['vacation_end'] ?? '';
        $this->reason = $data['reason'] ?? '';
        $this->user_id = $data['user_id'] ?? -1;
        $this->status = $data['status'] ?? '';
        $this->created_on = $data['created_on'] ?? '';
    }

    public function get_id(): int
    {
        return $this->id;
    }

    public function get_vacation_start(): string
    {
        return $this->vacation_start;
    }

    public function get_vacation_end(): string
    {
        return $this->vacation_end;
    }

    public function get_reason(): string
    {
        return $this->reason;
    }

    public function get_user_id(): int
    {
        return $this->user_id;
    }

    public function get_status(): string
    {
        return $this->status;
    }

    public function get_created_on(): string
    {
        return $this->created_on;
    }
}
