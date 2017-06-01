<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Brakes Model
 *
 * @property \Cake\ORM\Association\HasMany $Departures
 *
 * @method \App\Model\Entity\Brake get($primaryKey, $options = [])
 * @method \App\Model\Entity\Brake newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Brake[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Brake|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Brake patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Brake[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Brake findOrCreate($search, callable $callback = null, $options = [])
 */
class BrakesTable extends Table
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

        $this->setTable('brakes');
        $this->setDisplayField('type');
        $this->setPrimaryKey('id');

        $this->hasMany('Departures', [
            'foreignKey' => 'brake_id'
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
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        return $validator;
    }
}
