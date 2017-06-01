<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Arrival Entity
 *
 * @property int $id
 * @property int $way_id
 * @property int $train_id
 * @property int $train_set1_id
 * @property int $train_set2_id
 * @property int $train_set3_id
 * @property \Cake\I18n\Time $paris_nord_arrival
 * @property \Cake\I18n\Time $landy_arrival
 * @property string $comment_eic
 * @property string $comment_rlp
 * @property int $lavage_id
 * @property \Cake\I18n\Time $protection_time
 * @property \Cake\I18n\Time $announcement_time
 * @property string $push_pool
 *
 * @property \App\Model\Entity\Way $way
 * @property \App\Model\Entity\Train $train
 * @property \App\Model\Entity\TrainSet $train_set
 * @property \App\Model\Entity\Lavage $lavage
 */
class Arrival extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
