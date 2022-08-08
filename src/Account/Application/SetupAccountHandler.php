<?php

namespace App\Account\Application;

use App\Account\Domain\Account;
use App\Account\Domain\AccountRepositoryInterface;

final class SetupAccountHandler
{
    private AccountRepositoryInterface $accounts;

    public function __construct(AccountRepositoryInterface $accounts)
    {
        $this->accounts = $accounts;
    }

    public function __invoke(SetupAccountCommand $cmd)
    {
        $account = new Account($cmd->getId(), $cmd->getEmail());

        $this->accounts->add($account);
    }
}