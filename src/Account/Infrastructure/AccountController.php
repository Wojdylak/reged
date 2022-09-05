<?php

namespace App\Account\Infrastructure;

use App\Account\Application\AccountQueryInterface;
use App\Account\Application\AddAccountCommand;
use App\Account\Application\ViewAccountCommand;
use App\Shared\Infrastructure\CommandBusInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

final class AccountController
{
    private CommandBusInterface $bus;
    private AccountQueryInterface $accountQuery;

    public function __construct(CommandBusInterface $bus, AccountQueryInterface $accountQuery)
    {
        $this->bus = $bus;
        $this->accountQuery = $accountQuery;
    }

    public function viewAction(int $id): Response
    {
        return new JsonResponse($this->accountQuery->findById($id));
    }

    public function addAction(Request $request): Response
    {
        $payload = $request->toArray();
        $command = new AddAccountCommand($payload['email']);
        $this->bus->handle($command);

        return new Response(null, Response::HTTP_CREATED);
    }
}