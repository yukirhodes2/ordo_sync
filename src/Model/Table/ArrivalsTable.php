<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Arrivals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Ways
 * @property \Cake\ORM\Association\BelongsTo $Trains
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 * @property \Cake\ORM\Association\BelongsTo $Lavages
 *
 * @method \App\Model\Entity\Arrival get($primaryKey, $options = [])
 * @method \App\Model\Entity\Arrival newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Arrival[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Arrival|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Arrival patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Arrival[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Arrival findOrCreate($search, callable $callback = null, $options = [])
 */
class ArrivalsTable extends Table
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

        $this->setTable('arrivals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Ways', [
            'foreignKey' => 'way_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('ArrivalTrains', [
            'foreignKey' => 'train_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TrainSets', [
            'foreignKey' => 'train_set1_id'
        ]);
        $this->belongsTo('TrainSets', [
            'foreignKey' => 'train_set2_id'
        ]);
        $this->belongsTo('TrainSets', [
            'foreignKey' => 'train_set3_id'
        ]);
        $this->belongsTo('Lavages', [
            'foreignKey' => 'lavage_id'
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
            ->dateTime('paris_nord_arrival');

        $validator
            ->dateTime('landy_arrival')
            ->requirePresence('landy_arrival', 'create')
            ->notEmpty('landy_arrival');

        $validator
            ->allowEmpty('comment_eic');

        $validator
            ->allowEmpty('comment_rlp');

        $validator
            ->time('protection_time')
            ->allowEmpty('protection_time');

        $validator
            ->time('announcement_time')
            ->allowEmpty('announcement_time');

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
        $rules->add($rules->existsIn(['train_id'], 'ArrivalTrains'));
        $rules->add($rules->existsIn(['train_set1_id'], 'TrainSets'));
        $rules->add($rules->existsIn(['train_set2_id'], 'TrainSets'));
        $rules->add($rules->existsIn(['train_set3_id'], 'TrainSets'));
        $rules->add($rules->existsIn(['lavage_id'], 'Lavages'));

        return $rules;
    }
}
