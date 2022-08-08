<?php

namespace App\Account\Infrastructure;

use App\Account\Domain\Account;
use App\Account\Domain\AccountRepositoryInterface;

final class DoctrineOrmAccountRepository implements AccountRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findById(int $id): Account
    {
        return $this->em->fint(Account::class, $id);
    }
}