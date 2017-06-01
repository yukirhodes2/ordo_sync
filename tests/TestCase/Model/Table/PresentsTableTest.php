<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PresentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PresentsTable Test Case
 */
class PresentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PresentsTable
     */
    public $Presents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.presents',
        'app.brake_controls',
        'app.departures',
        'app.trains',
        'app.brakes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Presents') ? [] : ['className' => 'App\Model\Table\PresentsTable'];
        $this->Presents = TableRegistry::get('Presents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Presents);

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
