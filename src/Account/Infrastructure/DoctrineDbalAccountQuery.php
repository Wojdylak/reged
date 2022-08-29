<?php

namespace App\Account\Infrastructure;

use App\Account\Application\AccountQueryInterface;
use App\Account\Application\AccountView;
use Doctrine\DBAL\Connection;

final class DoctrineDbalAccountQuery implements AccountQueryInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findByEmail($email): AccountView
    {
        $sql = 'SELECT id, email FROM user WHERE email = :email';
        $data = $this->connection->exec($sql, ['email' => $email]);

        return new AccountView($data['id'], $data['email']);
    }
}