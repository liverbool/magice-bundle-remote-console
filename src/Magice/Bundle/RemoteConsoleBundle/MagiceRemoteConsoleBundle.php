<?php

namespace Magice\Bundle\RemoteConsoleBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MagiceRemoteConsoleBundle extends Bundle
{
    public function boot()
    {
        // setup to static call
        Console::setup($this->container);
    }
}
