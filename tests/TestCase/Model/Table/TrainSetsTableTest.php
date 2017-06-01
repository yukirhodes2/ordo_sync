<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainSetsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainSetsTable Test Case
 */
class TrainSetsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainSetsTable
     */
    public $TrainSets;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.train_sets',
        'app.train_set_releases',
        'app.releases',
        'app.release2s',
        'app.status'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TrainSets') ? [] : ['className' => 'App\Model\Table\TrainSetsTable'];
        $this->TrainSets = TableRegistry::get('TrainSets', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TrainSets);

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
