<?php

namespace Ntb\Statistics;

/**
 * Class StatisticController
 * @package Ntb\Statistics
 */
class StatisticController extends \Controller {

    /**
     *
     */
    public function index() {
        $indicators = IndicatorFactory::get_all();
        $adapter = AdapterFactory::create();

        if($adapter->canConnect()) {
            echo "Service can be reached...", "<br>";
            echo "Fetch indicators...", "<br>";
            echo "Indicators:", "<br>";
            $adapter->send($indicators);
            echo "Statistic was updated.", "<br>";
        } else {
            echo "Can't connect to service.", "<br>";
        }
    }
}