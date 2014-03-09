<?php
/**
 * ConsoleRemote
 * @author liverbool@gmail.com
 */
namespace Magice\Bundle\RemoteConsoleBundle\DependencyInjection;

use phpconsole\phpconsole;
use phpconsole\p;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ConsoleRemote implements ConsoleInterface
{
    /**
     * @var p
     */
    protected $console;
    protected $defaultProject;

    public function __construct($cfg = array())
    {
        $this->console = new phpconsole($cfg);

        if (isset($cfg['default_project'])) {
            $this->defaultProject = $cfg['default_project'];
        } else {
            $this->defaultProject = $cfg['projects'][array_keys($cfg['projects'])[0]];
        }
    }

    private function appendOption($option, $type = null)
    {
        if (empty($option)) {
            $option = array();
        } else {
            if (!is_array($option)) {
                $option = array('project' => $option);
            }

            if (!isset($option['project'])) {
                $option['project'] = $this->defaultProject;
            }
        }

        if ($type) {
            $option['type'] = $type;
        }

        return $option;
    }

    /**
     * Push generic data
     *
     * @param mixed $data
     * @param array $option
     *
     * @return bool|mixed
     */
    public function push($data, $option = array())
    {
        try {
            return $this->console->send($data, $this->appendOption($option));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Push trace exception
     *
     * @param \Exception $e
     * @param array      $option
     *
     * @return bool|mixed
     */
    public function trace(\Exception $e, $option = array())
    {
        try {
            return $this->console->send(
                sprintf("%s\r\n%s", $e->getMessage(), $e->getTraceAsString()),
                $this->appendOption($option, 'error')
            );
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Send generic data
     *
     * @param mixed $data
     * @param array $option
     *
     * @return bool|mixed
     */
    public function send($data, $option = array())
    {
        try {
            return $this->console->send($data, $this->appendOption($option));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Send data with info type
     *
     * @param  mixed $data
     * @param array  $option
     *
     * @return bool
     */
    public function info($data, $option = array())
    {
        try {
            return $this->console->send($data, $this->appendOption($option, 'info'));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Push data with success type
     *
     * @param mixed $data
     * @param array $option
     *
     * @return bool
     */
    public function success($data, $option = array())
    {
        try {
            return $this->console->send($data, $this->appendOption($option, 'success'));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Push data with error type
     *
     * @param mixed $data
     * @param array $option
     *
     * @return bool
     */
    public function error($data, $option = array())
    {
        try {
            return $this->console->send($data, $this->appendOption($option, 'error'));
        } catch (\Exception $e) {
            return false;
        }
    }
}