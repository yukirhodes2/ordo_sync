<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TheoricArrivals Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Trains
 *
 * @method \App\Model\Entity\TheoricArrival get($primaryKey, $options = [])
 * @method \App\Model\Entity\TheoricArrival newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TheoricArrival[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TheoricArrival|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TheoricArrival patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TheoricArrival[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TheoricArrival findOrCreate($search, callable $callback = null, $options = [])
 */
class TheoricArrivalsTable extends Table
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

        $this->setTable('theoric_arrivals');
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
            ->time('paris_nord_arrival')
            ->requirePresence('paris_nord_arrival', 'create')
            ->notEmpty('paris_nord_arrival');

        $validator
            ->integer('ascent_time')
            ->requirePresence('ascent_time', 'create')
            ->notEmpty('ascent_time');

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
