<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArrivalTrainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArrivalTrainsTable Test Case
 */
class ArrivalTrainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArrivalTrainsTable
     */
    public $ArrivalTrains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.arrival_trains',
        'app.arrivals',
        'app.ways',
        'app.departures',
        'app.trains',
        'app.theoric_arrivals',
        'app.theoric_departures',
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
        'app.lavages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ArrivalTrains') ? [] : ['className' => 'App\Model\Table\ArrivalTrainsTable'];
        $this->ArrivalTrains = TableRegistry::get('ArrivalTrains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArrivalTrains);

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
}
