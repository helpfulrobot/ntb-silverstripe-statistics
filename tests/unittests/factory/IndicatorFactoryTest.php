<?php

use Ntb\Statistics\IIndicator;

class IndicatorFactoryTest extends SapphireTest {

    public function testIndicatorCreation() {
        $indicators = \Ntb\Statistics\IndicatorFactory::get_all();

        $this->assertTrue(count($indicators) >= 1);
        $filtered = array_filter($indicators, function($indicator) {
            return $indicator instanceof TestIndicator;
        });

        $this->assertEquals(1, count($filtered));
        $this->assertEquals(1, $filtered[0]->fetch());
        $this->assertEquals("test.t", $filtered[0]->name());
    }
}

class TestIndicator implements IIndicator, TestOnly {

    public function fetch() {
        return 1;
    }

    public function name() {
        return "test.t";
    }
}