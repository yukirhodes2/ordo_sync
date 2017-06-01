<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TrainSetReleasesFixture
 *
 */
class TrainSetReleasesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'heure' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'release1_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'release2_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'status1_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'status2_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'train_set_id' => ['type' => 'integer', 'length' => 10, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'comment' => ['type' => 'string', 'length' => 256, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'status1_id' => ['type' => 'index', 'columns' => ['status1_id', 'status2_id'], 'length' => []],
            'release1_id' => ['type' => 'index', 'columns' => ['release1_id', 'release2_id', 'train_set_id'], 'length' => []],
            'train_set_id' => ['type' => 'index', 'columns' => ['train_set_id'], 'length' => []],
            'status2_id' => ['type' => 'index', 'columns' => ['status2_id'], 'length' => []],
            'release2_id' => ['type' => 'index', 'columns' => ['release2_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'train_set_releases_ibfk_1' => ['type' => 'foreign', 'columns' => ['status1_id'], 'references' => ['status', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'train_set_releases_ibfk_2' => ['type' => 'foreign', 'columns' => ['train_set_id'], 'references' => ['train_sets', 'id'], 'update' => 'cascade', 'delete' => 'cascade', 'length' => []],
            'train_set_releases_ibfk_3' => ['type' => 'foreign', 'columns' => ['status2_id'], 'references' => ['status', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'train_set_releases_ibfk_4' => ['type' => 'foreign', 'columns' => ['release1_id'], 'references' => ['releases', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
            'train_set_releases_ibfk_5' => ['type' => 'foreign', 'columns' => ['release2_id'], 'references' => ['releases', 'id'], 'update' => 'cascade', 'delete' => 'restrict', 'length' => []],
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
            'heure' => '2017-05-10 09:27:27',
            'release1_id' => 1,
            'release2_id' => 1,
            'status1_id' => 1,
            'status2_id' => 1,
            'train_set_id' => 1,
            'comment' => 'Lorem ipsum dolor sit amet',
            'active' => 1
        ],
    ];
}
