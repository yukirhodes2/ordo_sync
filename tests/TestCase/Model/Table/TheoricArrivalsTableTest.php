<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TheoricArrivalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TheoricArrivalsTable Test Case
 */
class TheoricArrivalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TheoricArrivalsTable
     */
    public $TheoricArrivals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.theoric_arrivals',
        'app.trains',
        'app.arrivals',
        'app.ways',
        'app.departures',
        'app.train_set1s',
        'app.train_set_releases',
        'app.releases1',
        'app.releases2',
        'app.status1',
        'app.status2',
        'app.train_sets',
        'app.train_set2s',
        'app.train_set3s',
        'app.brakes',
        'app.brake_controls',
        'app.presents',
        'app.lavages',
        'app.theoric_departures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TheoricArrivals') ? [] : ['className' => 'App\Model\Table\TheoricArrivalsTable'];
        $this->TheoricArrivals = TableRegistry::get('TheoricArrivals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TheoricArrivals);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
