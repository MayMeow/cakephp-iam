<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Iam\Model\Entity\Role;

/**
 * @property \Iam\Model\Table\RolesTable $Roles
 * @property \Iam\Model\Table\UsersTable $Users
 */
class RoleManagerService extends AppService implements RoleManagerServiceInterface
{
    public function initialize()
    {
        $this->loadModel('Iam.Roles');
        $this->loadModel('Iam.Users');
    }

    public function assignTo(int $userId, Role $role)
    {
        $user = $this->Users->get($userId);

        return $this->Roles->Users->link($role, [$user]);
    }

    public function removeFrom(int $userId, Role $role)
    {
        $user = $this->Users->get($userId);

        return $this->Roles->Users->unlink($role, [$user]);
    }
}