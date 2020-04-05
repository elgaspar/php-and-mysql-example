<?php

declare(strict_types=1);

require_once 'enum-application-status.php';


class Application
{
    private int $id;
    private string $vacation_start;
    private string $vacation_end;
    private string $reason;
    private int $user_id;
    private string $status;
    private string $approval_token;
    private string $created_on;

    public function __construct(array $data)
    {
        $this->id = -1;
        $this->vacation_start = '';
        $this->vacation_end = '';
        $this->reason = '';
        $this->user_id = -1;
        $this->status = '';
        $this->approval_token = bin2hex(random_bytes(16));
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
            'approval_token' => $this->approval_token,
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
        if (isset($data['status']) && ApplicationStatus::is_valid($data['status'])) {
            $this->status =  $data['status'];
        }
        $this->approval_token = $data['approval_token'] ?? $this->approval_token;
        $this->created_on = $data['created_on'] ?? $this->created_on;
    }

    public function approve(string $approval_token): bool
    {
        if ($this->approval_token && $this->approval_token == $approval_token) {
            $this->status = ApplicationStatus::APPROVED;
            $this->approval_token = '';
            return true;
        }
        return false;
    }

    public function reject(string $approval_token): bool
    {
        if ($this->approval_token && $this->approval_token == $approval_token) {
            $this->status = ApplicationStatus::REJECTED;
            $this->approval_token = '';
            return true;
        }
        return false;
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

    public function get_approval_token(): string
    {
        return $this->approval_token;
    }

    public function get_created_on(): string
    {
        return $this->created_on;
    }
}
