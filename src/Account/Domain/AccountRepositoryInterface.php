<?php

namespace App\Account\Domain;

interface AccountRepositoryInterface
{
    public function findById(int $id): Account;
}