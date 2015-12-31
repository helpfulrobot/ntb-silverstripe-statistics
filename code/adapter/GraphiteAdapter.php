<?php

namespace Ntb\Statistics;

/**
 * An adapter that can connect to graphite service.
 *
 * @package Ntb\Statistics
 */
class GraphiteAdapter extends AbstractNetworkAdapter implements IStatisticAdapter
{

    /**
     * @param $data
     * @param $time
     * @return mixed|void
     */
    protected function sendToService($data, $time)
    {
        $fp = $this->socket;

        foreach ($data as $name => $value) {
            // you need to send a newline for each message
            $message = implode(" ", [$name, $value, $time]) . PHP_EOL;
            fwrite($fp, $message);
        }
        fflush($fp);
        fclose($fp);
    }
}
