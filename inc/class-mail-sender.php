<?php

declare(strict_types=1);


class MailSender
{
    public static function to_admin(Application $application, string $employee_full_name): void
    {
        $config = Utilities::get_config();

        $admin_email = $config['admin_email'];
        $subject = 'New application has been submitted';
        $message = self::create_admin_content($application, $employee_full_name);
        $headers = self::create_headers();

        mail($admin_email, $subject, $message, $headers);
    }

    public static function to_employee(Application $application, bool $is_approved, $employee_email): void
    {
        $subject = 'Application review results';
        $message = self::create_employee_content($application, $is_approved);
        $headers = self::create_headers();

        mail($employee_email, $subject, $message, $headers);
    }



    private static function create_headers()
    {
        return $headers = array(
            'MIME-Version' => '1.0',
            'Content-type' => 'text/html; charset=iso-8859-1',

            'From' => 'info@phpandmysqlexample.com',
            // 'Reply-To' => 'webmaster@example.com',
            // 'X-Mailer' => 'PHP/' . phpversion()
        );
    }
    private static function create_admin_content(Application $application, string $employee_full_name): string
    {
        $approve_url = self::create_review_url($application, true);
        $reject_url = self::create_review_url($application, false);;

        $vacation_start_converted = date('d-m-Y', strtotime($application->get_vacation_start()));
        $vacation_end_converted = date('d-m-Y', strtotime($application->get_vacation_end()));
        $reason = $application->get_reason();

        return "<html><body>" .
            "Dear supervisor,<br><br>" .
            "Employee {$employee_full_name} requested for some time off,<br>" .
            "starting on {$vacation_start_converted} and ending on {$vacation_end_converted}, stating the reason:<br>" .
            "<span style='margin-left:10px;'>{$reason}</span><br><br>" .
            "Click on one of the below links to approve or reject the application:<br>" .
            "<a href='{$approve_url}'>Approve</a> - <a href='{$reject_url}'>Reject</a>" .
            "</body></html>";
    }

    private static function create_review_url(Application $application, bool $approve)
    {
        $base_url = $_SERVER['SERVER_NAME'];
        $id = $application->get_id();
        $token = $application->get_approval_token();
        return "http://{$base_url}/application-review.php?id={$id}&approve={$approve}&token={$token}";
    }

    private static function create_employee_content(Application $application, bool $is_approved): string
    {
        $result_text = $is_approved ? 'approved' : 'rejected';
        $submission_date = $application->get_created_on();
        return "<html><body>" .
            "Dear employee,<br><br>" .
            "your supervisor has <b>{$result_text}</b> your application submitted on <b>{$submission_date}</b>." .
            "</body></html>";
    }
}
