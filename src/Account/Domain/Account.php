<?php

namespace App\Account\Domain;

final class Account
{
    /** @var int  */
    private int $id;

    /** @var string  */
    private string $email;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}