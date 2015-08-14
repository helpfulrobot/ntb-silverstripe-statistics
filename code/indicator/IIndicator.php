<?php

namespace Ntb\Statistics;

/**
 * Indicator interface. An indicator is simply a key value pair where key is the name and value can be fetch from
 * database or another system.
 *
 * @package Ntb\Statistics
 */
interface IIndicator {

    /**
     *
     *
     * @return string|number
     */
    public function fetch();

    /**
     * Returns the name of an indicator. Levels should be separated with a `.` (example: `user.new`).
     *
     * @return string
     */
    public function name();
}