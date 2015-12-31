<?php
/**
 * Created by PhpStorm.
 * User: squad
 * Date: 09.08.15
 * Time: 23:43
 */

namespace Ntb\Statistics;

class StatisticTask extends \BuildTask
{

    protected $title = 'Realtime Statistics Task';

    protected $description = 'This task performs an update of the statistics data.';

    protected $enabled = true;

    /**
     *
     */
    public function run($request)
    {
        $indicators = IndicatorFactory::get_all();
        $adapter = AdapterFactory::create();

        if ($adapter->canConnect()) {
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
