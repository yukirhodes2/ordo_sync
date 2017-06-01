<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BrakeControlsFixture
 *
 */
class BrakeControlsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'departure_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'present_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'realisation_time' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'departure_id' => ['type' => 'index', 'columns' => ['departure_id', 'present_id'], 'length' => []],
            'present_id' => ['type' => 'index', 'columns' => ['present_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'brake_controls_ibfk_1' => ['type' => 'foreign', 'columns' => ['departure_id'], 'references' => ['departures', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'brake_controls_ibfk_2' => ['type' => 'foreign', 'columns' => ['present_id'], 'references' => ['presents', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'departure_id' => 1,
            'present_id' => 1,
            'realisation_time' => '2017-05-03 12:10:58'
        ],
    ];
}
