<?php

declare(strict_types=1);

require_once 'class-email.php';


class EmailForEmployee extends Email
{
    private const SUBJECT = 'Application review results';


    public function __construct(Application $application, bool $is_approved, $employee_email)
    {
        parent::__construct(
            $employee_email,
            self::SUBJECT,
            $this->generate_content($application, $is_approved)
        );
    }



    private function generate_content(Application $application, bool $is_approved): string
    {
        $result_text = $is_approved ? 'approved' : 'rejected';
        $submission_date = $application->get_created_on();
        return "<html><body>" .
            "Dear employee,<br><br>" .
            "your supervisor has <b>{$result_text}</b> your application submitted on <b>{$submission_date}</b>." .
            "</body></html>";
    }
}
