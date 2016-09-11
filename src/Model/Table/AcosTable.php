<?php
namespace MyAcl\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Acos Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ParentAcos
 * @property \Cake\ORM\Association\HasMany $ChildAcos
 * @property \Cake\ORM\Association\BelongsToMany $Aros
 *
 * @method \MyAcl\Model\Entity\Aco get($primaryKey, $options = [])
 * @method \MyAcl\Model\Entity\Aco newEntity($data = null, array $options = [])
 * @method \MyAcl\Model\Entity\Aco[] newEntities(array $data, array $options = [])
 * @method \MyAcl\Model\Entity\Aco|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \MyAcl\Model\Entity\Aco patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \MyAcl\Model\Entity\Aco[] patchEntities($entities, array $data, array $options = [])
 * @method \MyAcl\Model\Entity\Aco findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TreeBehavior
 */
class AcosTable extends Table
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

        $this->table('acos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Tree');

        $this->belongsTo('ParentAcos', [
            'className' => 'MyAcl.Acos',
            'foreignKey' => 'parent_id'
        ]);
        $this->hasMany('ChildAcos', [
            'className' => 'MyAcl.Acos',
            'foreignKey' => 'parent_id'
        ]);
        $this->belongsToMany('Aros', [
            'foreignKey' => 'aco_id',
            'targetForeignKey' => 'aro_id',
            'joinTable' => 'aros_acos',
            'className' => 'MyAcl.Aros'
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
        $rules->add($rules->existsIn(['parent_id'], 'ParentAcos'));

        return $rules;
    }
}
