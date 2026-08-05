<?php

namespace App;

class Application
{
    /**
     * @var ImapRepo
     */
    private $imap;

    /**
     * @var SmtpRepo
     */
    private $smtp;

    /**
     * @var array
     */
    private $addresses;

    public function __construct(ImapRepo $imap, SmtpRepo $smtp, array $addresses)
    {
        $this->imap = $imap;
        $this->smtp = $smtp;
        $this->addresses = $addresses;
    }

    public function __invoke(): void
    {
        foreach ($this->imap->read() as $mail) {
            foreach ($this->addresses as $to) {
                $this->smtp->send($to, $mail);
            }
            $this->imap->delete($mail['uid']);
        }
    }
}
