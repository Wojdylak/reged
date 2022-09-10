<?php

namespace App\Account\Application;

use App\Account\Domain\AccountRepositoryInterface;
use App\Shared\Application\HandlerInterface;

final class RemoveAccountHandler implements HandlerInterface
{

    private AccountRepositoryInterface $accountRepository;
    private AccountQueryInterface $accountQuery;

    public function __construct(AccountRepositoryInterface $accountRepository, AccountQueryInterface $accountQuery)
    {
        $this->accountRepository = $accountRepository;
        $this->accountQuery = $accountQuery;
    }

    public static function getDefaultIndexName(): string
    {
        return RemoveAccountCommand::class;
    }

    public function __invoke(RemoveAccountCommand $cmd): void
    {
        $account = $this->accountQuery->findById($cmd->getId());

        $this->accountRepository->remove($account);
    }
}