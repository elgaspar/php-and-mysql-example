<?php

abstract class UserType
{
    const ADMIN = 'admin';
    const EMPLOYEE = 'employee';


    public static function get_all(): array
    {
        return array(self::ADMIN, self::EMPLOYEE);
    }

    public static function is_valid(string $slug): bool
    {
        return ($slug == self::ADMIN || $slug == self::EMPLOYEE);
    }
}
