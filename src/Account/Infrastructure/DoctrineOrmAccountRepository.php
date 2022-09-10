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
        $this->em->beginTransaction();
        try {
            $this->em->persist($account);
            $this->em->flush();
            $this->em->commit();
        } catch (\Exception $exception) {
            $this->em->rollback();
        }
    }

    public function remove(Account $account)
    {
        $this->em->beginTransaction();
        try {
            $this->em->remove($account);
            $this->em->flush();
            $this->em->commit();
        } catch (\Exception $exception) {
            $this->em->rollback();
        }
    }
}