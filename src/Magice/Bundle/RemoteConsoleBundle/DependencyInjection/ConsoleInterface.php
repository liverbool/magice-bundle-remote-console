<?php
namespace Magice\Bundle\RemoteConsoleBundle\DependencyInjection;

interface ConsoleInterface
{
    public function push($data, $option = array());

    public function error($data, $option = array());

    public function info($data, $option = array());

    public function success($data, $option = array());

    public function trace(\Exception $exception, $option = array());
}