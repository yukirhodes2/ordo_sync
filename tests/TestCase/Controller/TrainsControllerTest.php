<?php
namespace App\Test\TestCase\Controller;

use App\Controller\TrainsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\TrainsController Test Case
 */
class TrainsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.trains',
        'app.train_sets',
        'app.train_set_releases',
        'app.releases',
        'app.release2s',
        'app.status',
        'app.arrivals',
        'app.lavages',
        'app.departures',
        'app.brakes',
        'app.brake_controls',
        'app.presents',
        'app.theoric_arrivals',
        'app.theoric_departures',
        'app.alerts'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
