<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\WaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\WaysTable Test Case
 */
class WaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\WaysTable
     */
    public $Ways;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ways',
        'app.arrivals',
        'app.trains',
        'app.train_sets',
        'app.train_set_releases',
        'app.releases',
        'app.status',
        'app.departures',
        'app.brakes',
        'app.brake_controls',
        'app.presents',
        'app.theoric_arrivals',
        'app.theoric_departures',
        'app.alerts',
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
        $config = TableRegistry::exists('Ways') ? [] : ['className' => 'App\Model\Table\WaysTable'];
        $this->Ways = TableRegistry::get('Ways', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ways);

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
