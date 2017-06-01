<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TrainSetRelease Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $heure
 * @property int $release1_id
 * @property int $release2_id
 * @property int $status1_id
 * @property int $status2_id
 * @property int $train_set_id
 * @property string $comment
 * @property bool $active
 *
 * @property \App\Model\Entity\Release $release
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\TrainSet $train_set
 */
class TrainSetRelease extends Entity
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
