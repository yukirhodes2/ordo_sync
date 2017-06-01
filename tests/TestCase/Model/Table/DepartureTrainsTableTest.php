<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DepartureTrainsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DepartureTrainsTable Test Case
 */
class DepartureTrainsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DepartureTrainsTable
     */
    public $DepartureTrains;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.departure_trains'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DepartureTrains') ? [] : ['className' => 'App\Model\Table\DepartureTrainsTable'];
        $this->DepartureTrains = TableRegistry::get('DepartureTrains', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DepartureTrains);

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
