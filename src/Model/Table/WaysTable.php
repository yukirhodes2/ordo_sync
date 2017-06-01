<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ways Model
 *
 * @property \Cake\ORM\Association\HasMany $Arrivals
 * @property \Cake\ORM\Association\HasMany $Departures
 *
 * @method \App\Model\Entity\Way get($primaryKey, $options = [])
 * @method \App\Model\Entity\Way newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Way[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Way|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Way patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Way[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Way findOrCreate($search, callable $callback = null, $options = [])
 */
class WaysTable extends Table
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

        $this->setTable('ways');
        $this->setDisplayField('numero');
        $this->setPrimaryKey('id');

        $this->hasMany('Arrivals', [
            'foreignKey' => 'way_id'
        ]);
        $this->hasMany('Departures', [
            'foreignKey' => 'way_id'
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
            ->integer('numero')
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        return $validator;
    }
}
