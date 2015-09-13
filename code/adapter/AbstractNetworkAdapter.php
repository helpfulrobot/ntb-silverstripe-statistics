<?php

namespace Ntb\Statistics;

/**
 *
 * @package Ntb\Statistics
 */
abstract class AbstractNetworkAdapter extends \Object {
    /**
     *
     * @var string
     */
    protected $host;

    /**
     * @var int
     */
    protected $port;

    /**
     * @var resource
     */
    protected $socket;

    /**
     * @param string $host
     * @param int $port
     */
    public function __construct($host, $port) {
        parent::__construct();

        $this->host = $host;
        $this->port = $port;

        $this->socket = $this->createSocket();
    }

    /**
     *
     *
     * @param IIndicator[] $indicators
     * @return array
     */
    protected function processIndicators($indicators) {
        $namespace = \Config::inst()->get('StatisticTask', 'Namespace');
        $separator = \Config::inst()->get('StatisticTask', 'Separator');
        if(!empty($namespace)) {
            $namespace .= $separator;
        } else {
            $namespace = '';
        }
        $data = [];
        foreach($indicators as $indicator) {
            $data[$namespace . $indicator->name()] = $indicator->fetch();
        }

        return $data;
    }

    /**
     *
     *
     * @return int
     */
    protected function currentTime() {
        return time();
    }

    /**
     *
     * @return resource
     */
    protected function createSocket() {
        $fp = @fsockopen("tcp://{$this->host}", $this->port, $errorNo, $errorMsg, 1);
        return $fp;
    }

    /**
     * @return bool
     */
    public function canConnect() {
        return is_resource($this->socket);
    }

    /**
     * @param $indicators
     */
    public function send($indicators) {
        $data = $this->processIndicators($indicators);
        $time = $this->currentTime();
        // send data over the wire to specified address
        $this->sendToService($data, $time);
    }

    /**
     * @param $data
     * @param $time
     * @return mixed
     */
    protected abstract function sendToService($data, $time);

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }
}