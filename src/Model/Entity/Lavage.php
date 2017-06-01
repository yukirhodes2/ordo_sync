<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lavage Entity
 *
 * @property int $id
 * @property string $libelle
 *
 * @property \App\Model\Entity\Arrival[] $arrivals
 */
class Lavage extends Entity
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
