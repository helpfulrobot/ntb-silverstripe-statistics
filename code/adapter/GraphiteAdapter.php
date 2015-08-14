<?php

namespace Ntb\Statistics;

/**
 * An adapter that can connect to graphite service.
 *
 * @package Ntb\Statistics
 */
class GraphiteStatisticAdapter extends \Object implements IStatisticAdapter {
    private $host;
    private $port;

    /**
     * @param string $host
     * @param int $port
     */
    public function __construct($host, $port) {
        parent::__construct();
        $this->host = $host;
        $this->port = $port;
    }
    /**
     * @param IIndicator[] $indicators
     * @return array
     */
    protected function processIndicators($indicators) {
        $namespace = \Config::inst()->get('StatisticController', 'Namespace');
        $separator = \Config::inst()->get('StatisticController', 'Separator');
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
     * @return int
     */
    protected function currentTime() {
        return time();
    }

    protected function createSocket() {
        $fp = @fsockopen("tcp://{$this->host}", $this->port, $errorNo, $errorMsg, 1);
        return $fp;
    }

    public function canConnect() {
        $fp = $this->createSocket();
        return (bool)$fp;
    }

    public function send($indicators) {
        $data = $this->processIndicators($indicators);
        $time = $this->currentTime();
        // send data over the wire to specified address
        $this->sendToService($data, $time);
    }

    protected function sendToService($data, $time) {
        $fp = $this->createSocket();

        foreach ($data as $name => $value) {
            // you need to send a newline for each message
            $message = implode(" ", [$name, $value, $time]) . PHP_EOL;
            echo " - $message<br>";
            fwrite($fp, $message);
        }
        fflush($fp);
        fclose($fp);
    }
}