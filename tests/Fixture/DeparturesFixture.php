<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DeparturesFixture
 *
 */
class DeparturesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'way_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'train_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'train_set1_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'train_set2_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'train_set3_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'paris_nord_departure' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'landy_departure' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'postep_departure' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'passagecarre_departure' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'refouleur_arrival' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'adc_arrival' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'comment_geops' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'comment_rlp' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'comment_cpt' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'comment_eic' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'annoucement' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'information' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'formed' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '0', 'comment' => '', 'precision' => null],
        'brake_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'osmose' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'restit' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'radio_number' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'push_pool' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'train_id' => ['type' => 'index', 'columns' => ['train_id'], 'length' => []],
            'brake_id' => ['type' => 'index', 'columns' => ['brake_id'], 'length' => []],
            'way_id' => ['type' => 'index', 'columns' => ['way_id'], 'length' => []],
            'train_set1_id' => ['type' => 'index', 'columns' => ['train_set1_id'], 'length' => []],
            'train_set2_id' => ['type' => 'index', 'columns' => ['train_set2_id'], 'length' => []],
            'train_set3_id' => ['type' => 'index', 'columns' => ['train_set3_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'departures_ibfk_1' => ['type' => 'foreign', 'columns' => ['brake_id'], 'references' => ['brakes', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'departures_ibfk_2' => ['type' => 'foreign', 'columns' => ['train_id'], 'references' => ['trains', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'departures_ibfk_3' => ['type' => 'foreign', 'columns' => ['way_id'], 'references' => ['ways', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'departures_ibfk_4' => ['type' => 'foreign', 'columns' => ['train_set1_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'departures_ibfk_5' => ['type' => 'foreign', 'columns' => ['train_set2_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'departures_ibfk_6' => ['type' => 'foreign', 'columns' => ['train_set3_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'way_id' => 1,
            'train_id' => 1,
            'train_set1_id' => 1,
            'train_set2_id' => 1,
            'train_set3_id' => 1,
            'paris_nord_departure' => '2017-05-10 15:05:49',
            'landy_departure' => '2017-05-10 15:05:49',
            'postep_departure' => '15:05:49',
            'passagecarre_departure' => '15:05:49',
            'refouleur_arrival' => '15:05:49',
            'adc_arrival' => '15:05:49',
            'comment_geops' => 'Lorem ipsum dolor sit amet',
            'comment_rlp' => 'Lorem ipsum dolor sit amet',
            'comment_cpt' => 'Lorem ipsum dolor sit amet',
            'comment_eic' => 'Lorem ipsum dolor sit amet',
            'annoucement' => '15:05:49',
            'information' => '15:05:49',
            'formed' => 1,
            'brake_id' => 1,
            'osmose' => '15:05:49',
            'restit' => '15:05:49',
            'radio_number' => 1,
            'push_pool' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
