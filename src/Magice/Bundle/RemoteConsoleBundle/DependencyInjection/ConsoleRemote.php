<?php
namespace Magice\Bundle\RemoteConsoleBundle\DependencyInjection;

use Phpconsole;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConsoleRemote implements ConsoleInterface
{
    /**
     * @var Phpconsole
     */
    protected $console;

    public function __construct($cfg = array())
    {
        $this->console = new Phpconsole();
        //$this->console->set_backtrace_depth(isset($cfg['depth']) ? $cfg['depth'] : 0);
        // some phpconsole error some time $bt = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS); not have $bt[][file]
        $this->console->disable_context();
        // see https://app.phpconsole.com/docs/auto-recognition for details
        $this->console->enable_auto_recognition($cfg['domain']);
        // you can add more developers, just execute another add_user()
        $this->console->add_user($cfg['nickname'], $cfg['apikey']);

    }

    public function push($data, $user = false)
    {
        try {
            return $this->console->send($data, $user);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function error(\Exception $e, $user = false)
    {
        try {
            return $this->console->send(sprintf('%s\n%s', $e->getMessage(), $e->getTraceAsString()), $user);
        } catch (\Exception $e) {
            return false;
        }
    }
}