<?php

namespace App\Shared\Infrastructure;

use App\Shared\Application\CommandInterface;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

final class SynchronousCommandBus implements CommandBusInterface
{
    private $handlers;

    public function map(string $command, callable $handler): void
    {
        $this->handlers[$command] = $handler;
    }

    public function handle(CommandInterface $command): void
    {
        $fqcn = get_class($command);
        $handlerNotFound = false === isset($this->handlers[$fqcn]);
//        HandlerNotFoundException::throwWhen($handlerNotFound, $fqcn);

        call_user_func($this->handlers[$fqcn], $command);
    }
}