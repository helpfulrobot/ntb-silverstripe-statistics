<?php

namespace Ntb\Statistics;

/**
 * Interface IStatisticAdapter
 * @package Ntb\Statistics
 */
interface IStatisticAdapter
{
    /**
     * Check the current connectivity ot the remote service.
     *
     * @return bool
     */
    public function canConnect();

    /**
     * Sends all given indicators to the configured service.
     *
     * @param IIndicator[] $indicators
     */
    public function send($indicators);
}
