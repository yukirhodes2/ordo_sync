<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrakeControls Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Departures
 * @property \Cake\ORM\Association\BelongsTo $Presents
 *
 * @method \App\Model\Entity\BrakeControl get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrakeControl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrakeControl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrakeControl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrakeControl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrakeControl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrakeControl findOrCreate($search, callable $callback = null, $options = [])
 */
class BrakeControlsTable extends Table
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

        $this->setTable('brake_controls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Departures', [
            'foreignKey' => 'departure_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Presents', [
            'foreignKey' => 'present_id'
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
            ->dateTime('realisation_time')
            ->allowEmpty('realisation_time');

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
        $rules->add($rules->existsIn(['departure_id'], 'Departures'));
        $rules->add($rules->existsIn(['present_id'], 'Presents'));

        return $rules;
    }
}
