<?php
namespace MyAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Aros Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentAros
 * @property \Cake\ORM\Association\HasMany $ChildAros
 * @property \Cake\ORM\Association\BelongsToMany $Acos
 *
 * @method \MyAcl\Model\Entity\Aro get($primaryKey, $options = [])
 * @method \MyAcl\Model\Entity\Aro newEntity($data = null, array $options = [])
 * @method \MyAcl\Model\Entity\Aro[] newEntities(array $data, array $options = [])
 * @method \MyAcl\Model\Entity\Aro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MyAcl\Model\Entity\Aro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MyAcl\Model\Entity\Aro[] patchEntities($entities, array $data, array $options = [])
 * @method \MyAcl\Model\Entity\Aro findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class ArosTable extends Table
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

        $this->table('aros');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentAros', [
            'className' => 'MyAcl.Aros',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildAros', [
            'className' => 'MyAcl.Aros',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Acos', [
            'foreignKey' => 'aro_id',
            'targetForeignKey' => 'aco_id',
            'joinTable' => 'aros_acos',
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
            ->allowEmpty('model');

        $validator
            ->integer('foreign_key')
            ->allowEmpty('foreign_key');

        $validator
            ->allowEmpty('alias');

        $validator
            ->integer('lft')
            ->allowEmpty('lft');

        $validator
            ->integer('rght')
            ->allowEmpty('rght');

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
        $rules->add($rules->existsIn(['parent_id'], 'ParentAros'));

        return $rules;
    }
}
