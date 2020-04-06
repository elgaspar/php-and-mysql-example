<?php

declare(strict_types=1);

require_once 'class-email.php';


class EmailForAdmin extends Email
{
    private const SUBJECT = 'New application has been submitted';


    public function __construct(Application $application, string $employee_full_name)
    {
        parent::__construct(
            $this->get_admin_email(),
            self::SUBJECT,
            $this->generate_content($application, $employee_full_name)
        );
    }



    private function get_admin_email(): string
    {
        $config = Utilities::get_config();
        return $config['admin_email'];
    }

    private function generate_content(Application $application, string $employee_full_name): string
    {
        $approve_url = $this->generate_review_url($application, true);
        $reject_url = $this->generate_review_url($application, false);;

        $vacation_start_converted = date('d-m-Y', strtotime($application->get_vacation_start()));
        $vacation_end_converted = date('d-m-Y', strtotime($application->get_vacation_end()));
        $reason = htmlspecialchars($application->get_reason());

        return "<html><body>" .
            "Dear supervisor,<br><br>" .
            "Employee {$employee_full_name} requested for some time off,<br>" .
            "starting on {$vacation_start_converted} and ending on {$vacation_end_converted}, stating the reason:<br>" .
            "<span style='margin-left:10px;'>{$reason}</span><br><br>" .
            "Click on one of the below links to approve or reject the application:<br>" .
            "<a href='{$approve_url}'>Approve</a> - <a href='{$reject_url}'>Reject</a>" .
            "</body></html>";
    }

    private function generate_review_url(Application $application, bool $approve): string
    {
        $base_url = $_SERVER['SERVER_NAME'];
        $id = $application->get_id();
        $token = $application->get_approval_token();
        return "http://{$base_url}/application-review.php?id={$id}&approve={$approve}&token={$token}";
    }
}
