<?php

namespace App\Account\Application;

use App\Shared\Application\CommandInterface;

final class AddAccountCommand implements CommandInterface
{
    private string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}