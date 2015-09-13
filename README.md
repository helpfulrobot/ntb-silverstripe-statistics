Realtime statistics for Silverstripe
====================================

This module makes it possible to create powerful dashboards about your application statistics with services like graphite and grafana.

For this purpose, the module contains a task system, that can be automatically run from a commandline through a script. On every run, the
available indicators will be fetched and send with use of an adapter.

## Available adapters

 * Graphite adapter
 * statsd adapter
 
## Write your indicators

To create your indicators you must implement `IIndicator` in your own classes. When the task runs, the indicators are
fetched automatically by the code. You can run the task in the browser in `dev/tasks/Ntb-Statistics-StatisticTask`
or by using the commandline interface.

```
use Ntb\Statistics\IIndicator;

class NewUserIndicator extends Object implements IIndicator {
    private static $name = ['user', 'new'];

    public function name() {
        $separator = \Config::inst()->get('StatisticController', 'Separator');
        return implode($separator, self::$name);
    }

    public function fetch() {
        return Member::get()->count();
    }
}
```