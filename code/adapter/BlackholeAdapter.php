<?php

namespace Ntb\Statistics;

class BlackholeAdapter extends \Object implements IStatisticAdapter
{

    /**
     * Check the current connectivity ot the remote service.
     *
     * @return bool
     */
    public function canConnect()
    {
        return true;
    }

    /**
     * Sends all given indicators to the configured service.
     *
     * @param IIndicator[] $indicators
     */
    public function send($indicators)
    {
        print_r($indicators);
    }
}
