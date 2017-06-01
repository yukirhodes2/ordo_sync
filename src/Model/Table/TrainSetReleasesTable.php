<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TrainSetReleases Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Releases
 * @property \Cake\ORM\Association\BelongsTo $Releases
 * @property \Cake\ORM\Association\BelongsTo $Status
 * @property \Cake\ORM\Association\BelongsTo $Status
 * @property \Cake\ORM\Association\BelongsTo $TrainSets
 *
 * @method \App\Model\Entity\TrainSetRelease get($primaryKey, $options = [])
 * @method \App\Model\Entity\TrainSetRelease newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TrainSetRelease[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TrainSetRelease|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TrainSetRelease patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TrainSetRelease[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TrainSetRelease findOrCreate($search, callable $callback = null, $options = [])
 */
class TrainSetReleasesTable extends Table
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

        $this->setTable('train_set_releases');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Releases1', [
            'foreignKey' => 'release1_id',
			'className' => 'Releases' 
        ]);
        $this->belongsTo('Releases2', [
            'foreignKey' => 'release2_id',
			'className' => 'Releases' 
        ]);
        $this->belongsTo('Status1', [
            'foreignKey' => 'status1_id',
			'className' => 'Status' 
        ]);
        $this->belongsTo('Status2', [
            'foreignKey' => 'status2_id',
			'className' => 'Status' 
        ]);
        $this->belongsTo('TrainSets', [
            'foreignKey' => 'train_set_id',
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
            ->dateTime('heure')
            ->allowEmpty('heure');

        $validator
            ->boolean('active')
            ->requirePresence('active', 'create')
            ->notEmpty('active');

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
        $rules->add($rules->existsIn(['release1_id'], 'Releases1'));
        $rules->add($rules->existsIn(['release2_id'], 'Releases2'));
        $rules->add($rules->existsIn(['status1_id'], 'Status1'));
        $rules->add($rules->existsIn(['status2_id'], 'Status2'));
        $rules->add($rules->existsIn(['train_set_id'], 'TrainSets'));

        return $rules;
    }
}
