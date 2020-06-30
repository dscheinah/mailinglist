<?php

namespace App;

use Eden\Mail\Smtp;

class SmtpRepo
{
    /**
     * @var Smtp
     */
    private $connector;

    public function __construct(Smtp $connector)
    {
        $this->connector = $connector;
    }

    public function __destruct()
    {
        $this->connector->disconnect();
    }

    public function send(string $to, array $mail): void
    {
        $this->connector->reset();
        $this->connector->addTo($to);
        $this->connector->setSubject($mail['subject']);
        foreach ($mail['attachment'] ?? [] as $name => $attachment) {
            foreach ($attachment as $mime => $content) {
                $this->connector->addAttachment($name, $content, $mime);
            }
        }
        if (isset($mail['body']['text/plain'])) {
            $this->connector->setBody($mail['body']['text/plain'], false);
        }
        if (isset($mail['body']['text/html'])) {
            $this->connector->setBody($mail['body']['text/html'], true);
        }
        $this->connector->send(
            [
                'Reply-To' => $mail['from']['email'],
                'Date' => $mail['date'],
                'Message-ID' => $mail['id'],
            ]
        );
    }
}
