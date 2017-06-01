<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TheoricDepartures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Trains
 *
 * @method \App\Model\Entity\TheoricDeparture get($primaryKey, $options = [])
 * @method \App\Model\Entity\TheoricDeparture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TheoricDeparture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TheoricDeparture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TheoricDeparture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TheoricDeparture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TheoricDeparture findOrCreate($search, callable $callback = null, $options = [])
 */
class TheoricDeparturesTable extends Table
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

        $this->setTable('theoric_departures');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Trains', [
            'foreignKey' => 'train_id',
            'joinType' => 'INNER'
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
            ->time('paris_nord_departure')
            ->requirePresence('paris_nord_departure', 'create')
            ->notEmpty('paris_nord_departure');

        $validator
            ->integer('docking_time')
            ->requirePresence('docking_time', 'create')
            ->notEmpty('docking_time');

        $validator
            ->integer('descent_duration')
            ->requirePresence('descent_duration', 'create')
            ->notEmpty('descent_duration');

        $validator
            ->integer('rendition_duration')
            ->requirePresence('rendition_duration', 'create')
            ->notEmpty('rendition_duration');

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
        $rules->add($rules->existsIn(['train_id'], 'Trains'));

        return $rules;
    }
}
