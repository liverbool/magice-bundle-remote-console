<?php
namespace Magice\Bundle\RemoteConsoleBundle\DependencyInjection;

interface ConsoleInterface {
    public function push($data, $user = false);
}