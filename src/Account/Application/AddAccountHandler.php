<?php

namespace App\Account\Application;

use App\Account\Domain\Account;
use App\Account\Domain\AccountRepositoryInterface;

final class AddAccountHandler
{
    private AccountRepositoryInterface $accounts;

    public function __construct(AccountRepositoryInterface $accounts)
    {
        $this->accounts = $accounts;
    }

    public function __invoke(AddAccountCommand $cmd): void
    {
        $account = new Account($cmd->getId(), $cmd->getEmail());

        $this->accounts->add($account);
    }
}