<?php

namespace App\Account\Infrastructure;

use App\Account\Application\AccountQueryInterface;
use App\Account\Application\AccountView;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Types;

final class DoctrineDbalAccountQuery implements AccountQueryInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findById(int $id): AccountView
    {
        $qb = $this->connection->createQueryBuilder();
        $qb
            ->select(
                'id',
                'email'
            )
            ->from('accounts')
            ->where($qb->expr()->eq('id', ':id'))
            ->setParameter('id', $id, Types::BIGINT)
        ;

        $data = $qb->fetchAssociative();
        return new AccountView($data['id'], $data['email']);
    }

    public function findByEmail($email): AccountView
    {
        $qb = $this->connection->createQueryBuilder();
        $qb
            ->select(
            'id',
                'email'
            )
            ->from('accounts')
            ->where($qb->expr()->eq('email', ':email'))
            ->setParameter('email', $email, Types::STRING)
        ;

        $data = $qb->fetchAssociative();

        return new AccountView($data['id'], $data['email']);
    }
}