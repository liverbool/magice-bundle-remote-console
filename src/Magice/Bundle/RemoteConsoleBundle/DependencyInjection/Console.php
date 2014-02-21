<?php
namespace Magice\Bundle\RemoteConsoleBundle\DependencyInjection;

use Phpconsole;

class Console implements ConsoleInterface
{
    /**
     * @var Phpconsole
     */
    protected $console;

    public function __construct($cfg = array())
    {
        $this->console = new Phpconsole();
        $this->console->set_backtrace_depth(isset($cfg['depth']) ? $cfg['depth'] : 1);
        // see https://app.phpconsole.com/docs/auto-recognition for details
        $this->console->enable_auto_recognition($cfg['domain']);
        // you can add more developers, just execute another add_user()
        $this->console->add_user($cfg['nickname'], $cfg['apikey']);

    }

    public function push($data, $user = false)
    {
        return $this->console->send($data, $user);
    }
}