<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LavagesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LavagesTable Test Case
 */
class LavagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LavagesTable
     */
    public $Lavages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lavages',
        'app.arrivals',
        'app.trains'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Lavages') ? [] : ['className' => 'App\Model\Table\LavagesTable'];
        $this->Lavages = TableRegistry::get('Lavages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lavages);

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
