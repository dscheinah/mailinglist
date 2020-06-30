<?php

namespace App;

use Sx\Data\BackendException;
use Sx\Data\Storage;

class Application
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * @var ImapRepo
     */
    private $imap;

    /**
     * @var SmtpRepo
     */
    private $smtp;

    /**
     * @var string
     */
    private $query;

    public function __construct(Storage $storage, ImapRepo $imap, SmtpRepo $smtp, string $query)
    {
        $this->storage = $storage;
        $this->imap = $imap;
        $this->smtp = $smtp;
        $this->query = $query;
    }

    /**
     * @throws BackendException
     */
    public function __invoke(): void
    {
        $addresses = [];
        foreach ($this->storage->fetch($this->query) as $result) {
            $addresses[] = current($result);
        }
        foreach ($this->imap->read() as $mail) {
            foreach ($addresses as $to) {
                $this->smtp->send($to, $mail);
            }
            $this->imap->delete($mail['uid']);
        }
        echo 'DONE';
    }
}
