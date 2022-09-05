<?php

namespace App\Account\Application;

use App\Account\Domain\Account;
use App\Account\Domain\AccountRepositoryInterface;
use App\Shared\Application\HandlerInterface;

final class AddAccountHandler implements HandlerInterface
{
    private AccountRepositoryInterface $accounts;

    public function __construct(AccountRepositoryInterface $accounts)
    {
        $this->accounts = $accounts;
    }

    public static function getDefaultIndexName(): string
    {
        return AddAccountCommand::class;
    }

    public function __invoke(AddAccountCommand $cmd): void
    {
        $account = new Account($cmd->getEmail());

        $this->accounts->add($account);
    }
}