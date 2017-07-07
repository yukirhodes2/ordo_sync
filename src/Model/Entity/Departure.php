<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * Departure Entity
 *
 * @property int $id
 * @property int $way_id
 * @property int $train_id
 * @property int $train_set1_id
 * @property int $train_set2_id
 * @property int $train_set3_id
 * @property \Cake\I18n\Time $paris_nord_departure
 * @property \Cake\I18n\Time $landy_departure
 * @property \Cake\I18n\Time $postep_departure
 * @property \Cake\I18n\Time $passagecarre_departure
 * @property \Cake\I18n\Time $refouleur_arrival
 * @property \Cake\I18n\Time $adc_arrival
 * @property string $comment_geops
 * @property string $comment_rlp
 * @property string $comment_cpt
 * @property string $comment_eic
 * @property \Cake\I18n\Time $annoucement
 * @property \Cake\I18n\Time $information
 * @property bool $formed
 * @property int $brake_id
 * @property \Cake\I18n\Time $osmose
 * @property \Cake\I18n\Time $restit
 * @property int $radio_number
 * @property string $push_pool
 *
 * @property \App\Model\Entity\Way $way
 * @property \App\Model\Entity\Train $train
 * @property \App\Model\Entity\TrainSet $train_set1
 * @property \App\Model\Entity\TrainSet $train_set2
 * @property \App\Model\Entity\TrainSet $train_set3
 * @property \App\Model\Entity\Brake $brake
 * @property \App\Model\Entity\BrakeControl[] $brake_controls
 */
class Departure extends Entity
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
	
	protected $_virtual = ['heure_restit'];
	
	protected function _getHeureRestit() {
		$heure_restit = date("H:i", $this->departure_train->theoric_departures[0]->paris_nord_departure->i18nFormat(Time::UNIX_TIMESTAMP_FORMAT)%(3600*24) - $this->departure_train->theoric_departures[0]->rendition_duration);
		return $heure_restit;
	}
}
