<?php
declare(strict_types=1);

namespace Iam\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RolesUsers Model
 *
 * @property \Iam\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \Iam\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Iam\Model\Entity\RolesUser newEmptyEntity()
 * @method \Iam\Model\Entity\RolesUser newEntity(array $data, array $options = [])
 * @method \Iam\Model\Entity\RolesUser[] newEntities(array $data, array $options = [])
 * @method \Iam\Model\Entity\RolesUser get($primaryKey, $options = [])
 * @method \Iam\Model\Entity\RolesUser findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Iam\Model\Entity\RolesUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Iam\Model\Entity\RolesUser[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Iam\Model\Entity\RolesUser|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\RolesUser saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\RolesUser[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\RolesUser[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\RolesUser[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\RolesUser[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RolesUsersTable extends Table
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

        $this->setTable('iam_roles_users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
            'className' => 'Iam.Roles',
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
            'className' => 'Iam.Users',
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
        $rules->add($rules->existsIn(['role_id'], 'Roles'), ['errorField' => 'role_id']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
