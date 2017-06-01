<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TheoricDeparture Entity
 *
 * @property int $id
 * @property int $train_id
 * @property \Cake\I18n\Time $paris_nord_departure
 * @property int $docking_time
 * @property int $descent_duration
 * @property int $rendition_duration
 *
 * @property \App\Model\Entity\Train $train
 * @property \App\Model\Entity\Alert $alert
 */
class TheoricDeparture extends Entity
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
