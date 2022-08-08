<?php

namespace App\Account\Application;

interface AccountQueryInterface
{
    public function findByEmail($email): AccountView;
}