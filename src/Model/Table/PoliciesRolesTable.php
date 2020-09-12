<?php
declare(strict_types=1);

namespace Iam\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoliciesRoles Model
 *
 * @property \Iam\Model\Table\PoliciesTable&\Cake\ORM\Association\BelongsTo $Policies
 * @property \Iam\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 *
 * @method \Iam\Model\Entity\PoliciesRole newEmptyEntity()
 * @method \Iam\Model\Entity\PoliciesRole newEntity(array $data, array $options = [])
 * @method \Iam\Model\Entity\PoliciesRole[] newEntities(array $data, array $options = [])
 * @method \Iam\Model\Entity\PoliciesRole get($primaryKey, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Iam\Model\Entity\PoliciesRole[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Iam\Model\Entity\PoliciesRole|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\PoliciesRole[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PoliciesRolesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('iam_policies_roles');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Policies', [
            'foreignKey' => 'policy_id',
            'joinType' => 'INNER',
            'className' => 'Iam.Policies',
        ]);
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
            'className' => 'Iam.Roles',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['policy_id'], 'Policies'), ['errorField' => 'policy_id']);
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);

        return $rules;
    }
}
