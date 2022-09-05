<?php

namespace App\Account\Application;

interface AccountQueryInterface
{
    public function findById(int $id): AccountView;
    public function findByEmail($email): AccountView;
}