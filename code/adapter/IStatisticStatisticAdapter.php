<?php

namespace Ntb\Statistics;

/**
 * Interface IStatisticAdapter
 * @package Ntb\Statistics
 */
interface IStatisticAdapter {
    /**
     * Check the current connectivity ot the remote service.
     *
     * @return bool
     */
    public function canConnect();

    /**
     *
     *
     * @param IIndicator[] $indicators
     */
    public function send($indicators);
}