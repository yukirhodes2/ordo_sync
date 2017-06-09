<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Departures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ways
 * @property \Cake\ORM\Association\BelongsTo $Trains
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 * @property \Cake\ORM\Association\BelongsTo $Brakes
 * @property \Cake\ORM\Association\HasMany $BrakeControls
 *
 * @method \App\Model\Entity\Departure get($primaryKey, $options = [])
 * @method \App\Model\Entity\Departure newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Departure[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Departure|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Departure patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Departure[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Departure findOrCreate($search, callable $callback = null, $options = [])
 */
class DeparturesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('departures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ways', [
            'foreignKey' => 'way_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DepartureTrains', [
            'foreignKey' => 'train_id',
            'joinType' => 'INNER'
        ]);
        // $this->belongsTo('TrainSets', [
            // 'foreignKey' => 'train_set1_id'
        // ]);
        // $this->belongsTo('TrainSets', [
            // 'foreignKey' => 'train_set2_id'
        // ]);
        // $this->belongsTo('TrainSets', [
            // 'foreignKey' => 'train_set3_id'
        // ]);
		
		$this->belongsTo('TrainSet1s', [
			'foreignKey' => 'train_set1_id',
			'className' => 'TrainSets'
			]);
		$this->belongsTo('TrainSet2s', [
			'foreignKey' => 'train_set2_id',
			'className' => 'TrainSets' 
			]);
		$this->belongsTo('TrainSet3s', [
			'foreignKey' => 'train_set3_id',
			'className' => 'TrainSets' 
			]);
        $this->belongsTo('Brakes', [
            'foreignKey' => 'brake_id'
        ]);
        $this->hasMany('BrakeControls', [
            'foreignKey' => 'departure_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->dateTime('paris_nord_departure')
            ->allowEmpty('paris_nord_departure');

        $validator
            ->dateTime('landy_departure')
            ->allowEmpty('landy_departure');

        $validator
            ->time('postep_departure')
            ->allowEmpty('postep_departure');

        $validator
            ->time('passagecarre_departure')
            ->allowEmpty('passagecarre_departure');

        $validator
            ->time('refouleur_arrival')
            ->allowEmpty('refouleur_arrival');

        $validator
            ->time('adc_arrival')
            ->allowEmpty('adc_arrival');

        $validator
            ->allowEmpty('comment_geops');

        $validator
            ->allowEmpty('comment_rlp');

        $validator
            ->allowEmpty('comment_cpt');

        $validator
            ->allowEmpty('comment_eic');

        $validator
            ->time('annoucement')
            ->allowEmpty('annoucement');

        $validator
            ->time('information')
            ->allowEmpty('information');

        $validator
            ->boolean('formed')
            ->requirePresence('formed', 'create')
            ->notEmpty('formed');

        $validator
            ->time('osmose')
            ->allowEmpty('osmose');

        $validator
            ->time('restit')
            ->allowEmpty('restit');

        $validator
            ->integer('radio_number')
            ->allowEmpty('radio_number');

        $validator
            ->allowEmpty('push_pool');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['way_id'], 'Ways'));
        $rules->add($rules->existsIn(['train_id'], 'DepartureTrains'));
        $rules->add($rules->existsIn(['train_set1_id'], 'TrainSet1s'));
        $rules->add($rules->existsIn(['train_set2_id'], 'TrainSet2s'));
        $rules->add($rules->existsIn(['train_set3_id'], 'TrainSet3s'));
        $rules->add($rules->existsIn(['brake_id'], 'Brakes'));

        return $rules;
    }
}
