<?php
namespace MyAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArosAcos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Aros
 * @property \Cake\ORM\Association\BelongsTo $Acos
 *
 * @method \MyAcl\Model\Entity\ArosAco get($primaryKey, $options = [])
 * @method \MyAcl\Model\Entity\ArosAco newEntity($data = null, array $options = [])
 * @method \MyAcl\Model\Entity\ArosAco[] newEntities(array $data, array $options = [])
 * @method \MyAcl\Model\Entity\ArosAco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MyAcl\Model\Entity\ArosAco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MyAcl\Model\Entity\ArosAco[] patchEntities($entities, array $data, array $options = [])
 * @method \MyAcl\Model\Entity\ArosAco findOrCreate($search, callable $callback = null)
 */
class ArosAcosTable extends Table
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

        $this->table('aros_acos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Aros', [
            'foreignKey' => 'aro_id',
            'joinType' => 'INNER',
            'className' => 'MyAcl.Aros'
        ]);
        $this->belongsTo('Acos', [
            'foreignKey' => 'aco_id',
            'joinType' => 'INNER',
            'className' => 'MyAcl.Acos'
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
            ->requirePresence('_create', 'create')
            ->notEmpty('_create');

        $validator
            ->requirePresence('_read', 'create')
            ->notEmpty('_read');

        $validator
            ->requirePresence('_update', 'create')
            ->notEmpty('_update');

        $validator
            ->requirePresence('_delete', 'create')
            ->notEmpty('_delete');

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
        $rules->add($rules->existsIn(['aro_id'], 'Aros'));
        $rules->add($rules->existsIn(['aco_id'], 'Acos'));

        return $rules;
    }
}
