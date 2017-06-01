<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ArrivalsFixture
 *
 */
class ArrivalsFixture extends TestFixture
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
        'paris_nord_arrival' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'landy_arrival' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'comment_eic' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'comment_rlp' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'lavage_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'protection_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'announcement_time' => ['type' => 'time', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'push_pool' => ['type' => 'string', 'length' => 256, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'train_id' => ['type' => 'index', 'columns' => ['train_id'], 'length' => []],
            'lavage_id' => ['type' => 'index', 'columns' => ['lavage_id'], 'length' => []],
            'way' => ['type' => 'index', 'columns' => ['way_id', 'train_set1_id', 'train_set2_id', 'train_set3_id'], 'length' => []],
            'train_set1_id' => ['type' => 'index', 'columns' => ['train_set1_id'], 'length' => []],
            'train_set2_id' => ['type' => 'index', 'columns' => ['train_set2_id'], 'length' => []],
            'train_set3_id' => ['type' => 'index', 'columns' => ['train_set3_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'arrivals_ibfk_1' => ['type' => 'foreign', 'columns' => ['train_id'], 'references' => ['trains', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'arrivals_ibfk_2' => ['type' => 'foreign', 'columns' => ['lavage_id'], 'references' => ['lavages', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'arrivals_ibfk_3' => ['type' => 'foreign', 'columns' => ['way_id'], 'references' => ['ways', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'arrivals_ibfk_4' => ['type' => 'foreign', 'columns' => ['train_set1_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'arrivals_ibfk_5' => ['type' => 'foreign', 'columns' => ['train_set2_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'arrivals_ibfk_6' => ['type' => 'foreign', 'columns' => ['train_set3_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'paris_nord_arrival' => '2017-05-10 15:54:21',
            'landy_arrival' => '2017-05-10 15:54:21',
            'comment_eic' => 'Lorem ipsum dolor sit amet',
            'comment_rlp' => 'Lorem ipsum dolor sit amet',
            'lavage_id' => 1,
            'protection_time' => '15:54:21',
            'announcement_time' => '15:54:21',
            'push_pool' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
