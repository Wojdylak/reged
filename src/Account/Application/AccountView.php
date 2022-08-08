<?php

namespace App\Account\Application;

final class AccountView
{
    public int $id;
    public string $email;

    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }
}