<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TrainSetReleasesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TrainSetReleasesTable Test Case
 */
class TrainSetReleasesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TrainSetReleasesTable
     */
    public $TrainSetReleases;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.train_set_releases',
        'app.releases',
        'app.status',
        'app.train_sets'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TrainSetReleases') ? [] : ['className' => 'App\Model\Table\TrainSetReleasesTable'];
        $this->TrainSetReleases = TableRegistry::get('TrainSetReleases', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TrainSetReleases);

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
