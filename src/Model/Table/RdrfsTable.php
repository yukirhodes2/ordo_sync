<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Rdrfs Model
 *
 * @method \App\Model\Entity\Rdrf get($primaryKey, $options = [])
 * @method \App\Model\Entity\Rdrf newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Rdrf[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Rdrf|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Rdrf patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Rdrf[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Rdrf findOrCreate($search, callable $callback = null, $options = [])
 */
class RdrfsTable extends Table
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

        $this->setTable('rdrfs');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->requirePresence('libelle', 'create')
            ->notEmpty('libelle');

        return $validator;
    }
}
