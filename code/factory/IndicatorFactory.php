<?php
/**
 * Created by PhpStorm.
 * User: squad
 * Date: 09.08.15
 * Time: 10:11
 */

namespace Ntb\Statistics;

/**
 * Class IndicatorFactory
 * @package Ntb\Statistics
 */
class IndicatorFactory extends \Object {
    /**
     * @var string
     */
    private static $interface_name = 'Ntb\Statistic\IIndicator';

    /**
     *
     *
     * @return IIndicator[]
     */
    public static function get_all() {
        $indicators = [
            new NewUserIndicator(),
            new UserCompleteIndicator()
        ];

        return $indicators;
    }

    /**
     *
     *
     * @param string $className
     * @param string $interface
     * @return bool
     */
    public static function implements_interface($className, $interface) {
        return in_array($interface, class_implements($className));
    }
}