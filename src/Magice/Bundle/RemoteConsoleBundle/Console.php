<?php
namespace Magice\Bundle\RemoteConsoleBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method static push($data, $option = array())
 * @method static trace(\Exception $exception, $option = array())
 * @method static send($data, $option = array())
 * @method static info($data, $option = array())
 * @method static success($data, $option = array())
 * @method static error($data, $option = array())
 */
class Console
{
    /** @var Console
     */
    private static $instance;

    public static function setup(ContainerInterface $container)
    {
        self::$instance = $container->get('console');
    }

    public static function __callStatic($name, $args)
    {
        return call_user_func_array(array(self::$instance, $name), $args);
    }
}