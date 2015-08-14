<?php
/**
 * Created by PhpStorm.
 * User: squad
 * Date: 09.08.15
 * Time: 23:43
 */

namespace Ntb\Statistics;


class StatisticTask extends \BuildTask {

    protected $title = 'Realtime Statistics Task';

    protected $description = 'This task performs an update of the statistics data.';

    protected $enabled = true;

    /**
     *
     */
    public function run($request) {
        $controller = new StatisticController();
        $controller->index();
    }
}