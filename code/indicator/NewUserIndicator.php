<?php

namespace Ntb\Statistics;

/**
 * Class NewUserIndicator
 *
 * @package Ntb\Statistics
 */
class NewUserIndicator extends \Object implements IIndicator {
    private static $name = ['user', 'new'];

    public function name() {
        $separator = \Config::inst()->get('StatisticController', 'Separator');
        return implode($separator, self::$name);
    }

    public function fetch() {
        return \DataObject::get('Member')->count();
    }
}