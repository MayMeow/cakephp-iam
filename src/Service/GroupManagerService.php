<?php

namespace Iam\Service;

use App\Service\AppService;

/**
 * Class GroupManagerService
 * @package Iam\Service
 *
 * @property \Iam\Model\Table\GroupsTable $Groups
 */
class GroupManagerService extends AppService implements GroupManagerServiceInterface
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub

        $this->loadModel('Iam.Groups');
    }

    /**
     * createAdministrators method
     *
     * @return int Result state
     *
     * 1 - Group was created
     * 2 - Group cannot be created
     * 0 - Group is already existing
     */
    public function createAdministrators() : int
    {
        $newGroup = $this->Groups->newEmptyEntity();
        $newGroup->name = 'Administrators';
        $newGroup->description = 'Default administrators group';

        if ($this->Groups->find()->where(['Groups.name' => $newGroup->name])->first() == null) {
            if ($this->Groups->save($newGroup)) {
                return 1;
            } else {
                return 2;
            }
        }

        return 0;
    }
}
