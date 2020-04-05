<?php

abstract class ApplicationStatus
{
    const PENDING = 'pending';
    const APPROVED = 'approved';
    const REJECTED = 'rejected';


    public static function get_all(): array
    {
        return array(self::PENDING, self::APPROVED, self::REJECTED);
    }

    public static function is_valid(string $slug): bool
    {
        return ($slug == self::PENDING || $slug == self::APPROVED || $slug == self::REJECTED);
    }
}
