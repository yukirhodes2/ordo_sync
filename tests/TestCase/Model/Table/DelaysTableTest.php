<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DelaysTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DelaysTable Test Case
 */
class DelaysTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DelaysTable
     */
    public $Delays;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.delays'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Delays') ? [] : ['className' => 'App\Model\Table\DelaysTable'];
        $this->Delays = TableRegistry::get('Delays', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Delays);

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
