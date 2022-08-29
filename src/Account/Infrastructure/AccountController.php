<?php

namespace App\Account\Infrastructure;

use App\Account\Application\SetupAccountCommand;
use App\Shared\Infrastructure\CommandBusInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

final class AccountController
{
    private CommandBusInterface $bus;
    private RouterInterface $router;

    public function __construct(CommandBusInterface $bus, RouterInterface $router)
    {

        $this->bus = $bus;
        $this->router = $router;
    }

    public function setupAction(Request $request): Response
    {
//        $id = generateId();
        $id = 1;
        $payload = $request->request->all();
        $command = new SetupAccountCommand($id, $payload['email']);
        $this->bus->handle($command);

        return new Response(null, Response::HTTP_CREATED, [
            'Location' => $this->router->generate('account.view', [$id]),
        ]);
    }
}