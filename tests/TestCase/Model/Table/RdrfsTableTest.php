<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RdrfsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RdrfsTable Test Case
 */
class RdrfsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RdrfsTable
     */
    public $Rdrfs;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rdrfs'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Rdrfs') ? [] : ['className' => 'App\Model\Table\RdrfsTable'];
        $this->Rdrfs = TableRegistry::get('Rdrfs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Rdrfs);

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
