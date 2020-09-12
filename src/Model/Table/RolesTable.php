<?php
declare(strict_types=1);

namespace Iam\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Roles Model
 *
 * @method \Iam\Model\Entity\Role newEmptyEntity()
 * @method \Iam\Model\Entity\Role newEntity(array $data, array $options = [])
 * @method \Iam\Model\Entity\Role[] newEntities(array $data, array $options = [])
 * @method \Iam\Model\Entity\Role get($primaryKey, $options = [])
 * @method \Iam\Model\Entity\Role findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Iam\Model\Entity\Role patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Iam\Model\Entity\Role[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Iam\Model\Entity\Role|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\Role saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class RolesTable extends Table
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

        $this->setTable('iam_roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
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

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

        $validator
            ->scalar('normalized_name')
            ->maxLength('normalized_name', 255)
            ->requirePresence('normalized_name', 'create')
            ->notEmptyString('normalized_name');

        $validator
            ->scalar('description')
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->uuid('uuid')
            ->requirePresence('uuid', 'create')
            ->notEmptyString('uuid');

        return $validator;
    }
}
