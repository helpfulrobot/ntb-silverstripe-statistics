<?php

namespace Ntb\Statistics;

/**
 * Adapter factory for creating statistic adapters.
 *
 * @package Ntb\Statistics
 */
class AdapterFactory
{
    /**
     * The adapter interface name
     * @var string
     */
    private static $interface_name = 'Ntb\Statistics\IStatisticAdapter';

    /**
     *
     *
     * @return IStatisticAdapter
     * @throws \Exception
     */
    public static function create()
    {
        $host = \Config::inst()->get('AdapterFactory', 'Host');
        $port = \Config::inst()->get('AdapterFactory', 'Port');
        $type = \Config::inst()->get('AdapterFactory', 'Adapter');
        $adapters = \ClassInfo::implementorsOf(self::$interface_name);

        if (in_array($type, $adapters)) {
            return \Object::create($type, $host, $port);
        } else {
            throw new \Exception("Configured adapter '$type' not found.");
        }
    }
}
