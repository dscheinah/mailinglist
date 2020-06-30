<?php

namespace App;

use Eden\Mail\Imap;
use Generator;

class ImapRepo
{
    /**
     * @var Imap
     */
    private $connector;

    public function __construct(Imap $connector)
    {
        $this->connector = $connector;
    }

    public function __destruct()
    {
        $this->connector->disconnect();
    }

    public function read(): Generator
    {
        foreach ($this->connector->getEmails() as $mail) {
            yield $this->connector->getUniqueEmails($mail['uid'], true);
        }
    }

    public function delete(string $id): void
    {
        $this->connector->remove($id);
    }
}
