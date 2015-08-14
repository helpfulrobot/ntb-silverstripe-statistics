<?php

namespace Ntb\Statistics;

/**
 * Class AdapterFactory
 * @package Ntb\Statistics
 */
class AdapterFactory extends \Object {

    /**
     * @return IStatisticAdapter
     */
    public static function create() {
        $host = \Config::inst()->get('AdapterFactory', 'Host');
        $port = \Config::inst()->get('AdapterFactory', 'Port');
        $type = \Config::inst()->get('AdapterFactory', 'Adapter');

        if($type == 'GraphiteAdapter') {
            return self::create_graphite_adapter($host, $port);
        }
    }
    /**
     * @return GraphiteStatisticAdapter
     */
    public static function create_graphite_adapter($host, $port) {
        return new GraphiteStatisticAdapter($host, $port);
    }
}