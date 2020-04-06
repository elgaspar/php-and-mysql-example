<?php

declare(strict_types=1);


class Email
{
    private const HEADERS = array(
        'MIME-Version' => '1.0',
        'Content-type' => 'text/html; charset=iso-8859-1',
        'From' => 'info@phpandmysqlexample.com',
    );

    private string $destination_email;
    private string $subject;
    private string $message;

    public function __construct($destination_email, $subject, $message)
    {
        $this->destination_email = $destination_email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function send(): bool
    {
        return mail($this->destination_email, $this->subject, $this->message, self::HEADERS);
    }
}
