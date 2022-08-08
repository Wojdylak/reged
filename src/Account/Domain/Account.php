<?php

namespace App\Account\Domain;

final class Account
{
    private int $id;
    private string $email;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}