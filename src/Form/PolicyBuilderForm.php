<?php
declare(strict_types=1);

namespace Iam\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

/**
 * PolicyBuilder Form.
 */
class PolicyBuilderForm extends Form
{
    /**
     * Builds the schema for the modelless form
     *
     * @param \Cake\Form\Schema $schema From schema
     * @return \Cake\Form\Schema
     */
    protected function _buildSchema(Schema $schema): Schema
    {
        return $schema
            ->addField('plugin', 'string')
            ->addField('prefix', 'string')
            ->addField('controller', 'string')
            ->addField('action', 'string')
            ->addField('description', 'string');
    }

    /**
     * Form validation builder
     *
     * @param \Cake\Validation\Validator $validator to use against the form
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('controller')
            ->requirePresence('controller')
            ->notEmptyString('controller');

        $validator
            ->scalar('action')
            ->requirePresence('action')
            ->notEmptyString('action');

        $validator
            ->scalar('description')
            ->requirePresence('description')
            ->notEmptyString('description');

        return $validator;
    }

    /**
     * Defines what to execute once the Form is processed
     *
     * @param array $data Form data.
     * @return bool
     */
    protected function _execute(array $data): bool
    {
        return true;
    }
}
