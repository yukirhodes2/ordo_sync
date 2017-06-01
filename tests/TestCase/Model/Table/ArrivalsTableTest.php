<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArrivalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArrivalsTable Test Case
 */
class ArrivalsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArrivalsTable
     */
    public $Arrivals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Arrivals') ? [] : ['className' => 'App\Model\Table\ArrivalsTable'];
        $this->Arrivals = TableRegistry::get('Arrivals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Arrivals);

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
