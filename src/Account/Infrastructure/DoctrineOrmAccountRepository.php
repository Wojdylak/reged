<?php

namespace App\Account\Infrastructure;

use App\Account\Domain\Account;
use App\Account\Domain\AccountRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class DoctrineOrmAccountRepository implements AccountRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findById(int $id): Account
    {
        return $this->em->find(Account::class, $id);
    }

    public function add(Account $account)
    {

    }
}