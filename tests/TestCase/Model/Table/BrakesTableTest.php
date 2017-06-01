<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BrakesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BrakesTable Test Case
 */
class BrakesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BrakesTable
     */
    public $Brakes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.brakes',
        'app.departures'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Brakes') ? [] : ['className' => 'App\Model\Table\BrakesTable'];
        $this->Brakes = TableRegistry::get('Brakes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Brakes);

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
