<?php
declare(strict_types=1);

namespace Iam\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Policies Model
 *
 * @method \Iam\Model\Entity\Policy newEmptyEntity()
 * @method \Iam\Model\Entity\Policy newEntity(array $data, array $options = [])
 * @method \Iam\Model\Entity\Policy[] newEntities(array $data, array $options = [])
 * @method \Iam\Model\Entity\Policy get($primaryKey, $options = [])
 * @method \Iam\Model\Entity\Policy findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Iam\Model\Entity\Policy patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Iam\Model\Entity\Policy[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Iam\Model\Entity\Policy|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\Policy saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PoliciesTable extends Table
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

        $this->setTable('iam_policies');
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

        return $validator;
    }
}
