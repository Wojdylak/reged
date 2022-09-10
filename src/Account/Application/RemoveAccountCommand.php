<?php

namespace App\Account\Application;

use App\Shared\Application\CommandInterface;

final class RemoveAccountCommand implements CommandInterface
{
    private int $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}