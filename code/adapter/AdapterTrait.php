<?php

namespace Ntb\Statistics;

/**
 * Class AdapterTrait
 * @package Ntb\Statistics
 */
trait AdapterTrait {

    /**
     * @param IIndicator[] $indicators
     * @return array
     */
    protected function processIndicators($indicators) {
        $data = [];
        foreach($indicators as $indicator) {
            $data[$indicator->name()] = $indicator->fetch();
        }

        return $data;
    }

    /**
     * @return \DateTime
     */
    protected function currentTime() {
        return new \DateTime();
    }
}