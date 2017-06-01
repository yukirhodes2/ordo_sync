<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BrakeControl Entity
 *
 * @property int $id
 * @property int $departure_id
 * @property int $present_id
 * @property \Cake\I18n\Time $realisation_time
 *
 * @property \App\Model\Entity\Departure $departure
 * @property \App\Model\Entity\Present $present
 */
class BrakeControl extends Entity
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
