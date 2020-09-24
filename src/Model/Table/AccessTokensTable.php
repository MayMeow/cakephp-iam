<?php
declare(strict_types=1);

namespace Iam\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * AccessTokens Model
 *
 * @property \Iam\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \Iam\Model\Entity\AccessToken newEmptyEntity()
 * @method \Iam\Model\Entity\AccessToken newEntity(array $data, array $options = [])
 * @method \Iam\Model\Entity\AccessToken[] newEntities(array $data, array $options = [])
 * @method \Iam\Model\Entity\AccessToken get($primaryKey, $options = [])
 * @method \Iam\Model\Entity\AccessToken findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \Iam\Model\Entity\AccessToken patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \Iam\Model\Entity\AccessToken[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \Iam\Model\Entity\AccessToken|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\AccessToken saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \Iam\Model\Entity\AccessToken[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\AccessToken[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\AccessToken[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \Iam\Model\Entity\AccessToken[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccessTokensTable extends Table
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

        $this->setTable('iam_access_tokens');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            // ->requirePresence('token', 'create')
            ->notEmptyString('token');

        $validator
            ->scalar('token_plain')
            ->maxLength('token_plain', 255)
            // ->requirePresence('token_plain', 'create')
            ->notEmptyString('token_plain');

        $validator
            ->boolean('can_read')
            ->notEmptyString('can_read');

        $validator
            ->boolean('can_write')
            ->notEmptyString('can_write');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

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
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
