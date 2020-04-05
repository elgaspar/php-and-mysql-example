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
        $this->id = -1;
        $this->vacation_start = '';
        $this->vacation_end = '';
        $this->reason = '';
        $this->user_id = -1;
        $this->status = '';
        $this->created_on = '';

        $this->set_data_array($data);
    }

    public function get_data_array(): array
    {
        return array(
            'id' => $this->id,
            'vacation_start' => $this->vacation_start,
            'vacation_end' => $this->vacation_end,
            'reason' => $this->reason,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'created_on' => $this->created_on
        );
    }

    public function set_data_array(array $data): void
    {
        $this->id = $data['id'] ?? $this->id;
        $this->vacation_start = $data['vacation_start'] ?? $this->vacation_start;
        $this->vacation_end = $data['vacation_end'] ?? $this->vacation_end;
        $this->reason = $data['reason'] ?? $this->reason;
        $this->user_id = $data['user_id'] ?? $this->user_id;
        $this->status = $data['status'] ?? $this->status;
        $this->created_on = $data['created_on'] ?? $this->created_on;
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
