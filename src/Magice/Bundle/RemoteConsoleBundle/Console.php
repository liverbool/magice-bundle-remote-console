<?php
namespace Magice\Bundle\RemoteConsoleBundle;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @method static push($data, $user = false)
 * @method static error(\Exception $e, $user = false)
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

    public function __callStatic($name, $args)
    {
        return call_user_func_array(array(self::$instance, $name), $args);
    }
}