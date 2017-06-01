<?php
namespace App\Test\TestCase\Controller;

use App\Controller\ArrivalsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\ArrivalsController Test Case
 */
class ArrivalsControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.arrivals',
        'app.ways',
        'app.departures',
        'app.trains',
        'app.theoric_arrivals',
        'app.theoric_departures',
        'app.alerts',
        'app.train_sets',
        'app.train_set_releases',
        'app.releases',
        'app.status',
        'app.brakes',
        'app.brake_controls',
        'app.presents',
        'app.lavages'
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
