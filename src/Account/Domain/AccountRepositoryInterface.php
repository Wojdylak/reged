<?php

namespace App\Account\Domain;

interface AccountRepositoryInterface
{
    public function findById(int $id): Account;

    public function add(Account $account);

    public function remove(Account $account);
}