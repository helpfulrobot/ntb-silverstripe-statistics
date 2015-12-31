<?php

use Ntb\Statistics\AdapterFactory;

class AdapterFactoryTest extends SapphireTest
{

    // test config
    public function testAdapterCreationFromConfig()
    {
        $configuredAdapter = Config::inst()->get('AdapterFactory', 'Adapter');
        $adapter = AdapterFactory::create();

        $this->assertEquals($configuredAdapter, $adapter->class);
    }
    // test specific
    public function testAdapterCreationWithChangeOfConfig()
    {
        $configuredAdapter = 'Ntb\Statistics\GraphiteAdapter';
        Config::inst()->update('AdapterFactory', 'Adapter', $configuredAdapter);
        $adapter = AdapterFactory::create();

        $this->assertEquals($configuredAdapter, $adapter->class);
    }
    // test host and port
    public function testAdapterCreation()
    {
        $port = 1234;
        $host = 'foo.bar';
        Config::inst()->update('AdapterFactory', 'Adapter', 'Ntb\Statistics\StatsDAdapter');
        Config::inst()->update('AdapterFactory', 'Host', $host);
        Config::inst()->update('AdapterFactory', 'Port', $port);


        $adapter = AdapterFactory::create();

        $this->assertEquals($port, $adapter->getPort());
    }

    public function testUnresolvableAdapter()
    {
        $configuredAdapter = 'ErrorAdapter';
        Config::inst()->update('AdapterFactory', 'Adapter', $configuredAdapter);
        $thrown = false;

        try {
            $adapter = AdapterFactory::create();
        } catch (Exception $e) {
            $thrown = true;
        } finally {
            $this->assertTrue($thrown);
        }
    }
}
