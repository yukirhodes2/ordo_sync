<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrakeControlsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrakeControlsTable Test Case
 */
class BrakeControlsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrakeControlsTable
     */
    public $BrakeControls;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brake_controls',
        'app.departures',
        'app.ways',
        'app.arrivals',
        'app.trains',
        'app.theoric_arrivals',
        'app.theoric_departures',
        'app.alerts',
        'app.train_sets',
        'app.train_set_releases',
        'app.releases',
        'app.status',
        'app.lavages',
        'app.brakes',
        'app.presents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('BrakeControls') ? [] : ['className' => 'App\Model\Table\BrakeControlsTable'];
        $this->BrakeControls = TableRegistry::get('BrakeControls', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->BrakeControls);

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
