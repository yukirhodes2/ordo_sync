<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReleasesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReleasesTable Test Case
 */
class ReleasesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ReleasesTable
     */
    public $Releases;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.releases'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Releases') ? [] : ['className' => 'App\Model\Table\ReleasesTable'];
        $this->Releases = TableRegistry::get('Releases', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Releases);

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
