<?php

namespace App\Account\Domain;

final class Account
{
    /** @var int  */
    private int $id;

    /** @var string  */
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}