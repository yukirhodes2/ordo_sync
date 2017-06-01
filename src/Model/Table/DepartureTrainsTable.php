<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArrivalTrains Model
 *
 * @property \Cake\ORM\Association\HasMany $Departures
 * @property \Cake\ORM\Association\HasMany $Departures
 * @property \Cake\ORM\Association\HasMany $TheoricDepartures
 * @property \Cake\ORM\Association\HasMany $TheoricDepartures
 *
 * @method \App\Model\Entity\Train get($primaryKey, $options = [])
 * @method \App\Model\Entity\Train newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Train[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Train|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Train patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Train[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Train findOrCreate($search, callable $callback = null, $options = [])
 */
class DepartureTrainsTable extends Table
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

        $this->setTable('departure_trains');
        $this->setDisplayField('numero');
        $this->setPrimaryKey('id');

        $this->hasMany('Departures', [
            'foreignKey' => 'train_id'
        ]);
        $this->hasMany('TheoricDepartures', [
            'foreignKey' => 'train_id'
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
            ->requirePresence('numero', 'create')
            ->notEmpty('numero');

        return $validator;
    }
}
