<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Iam\Model\Entity\Policy;

/**
 * @property \Iam\Model\Table\RolesTable $Roles
 * @property \Iam\Model\Table\PoliciesTable $Policies
 */
class PolicyManagerService extends AppService implements PolicyManagerServiceInterface
{
    public function initialize()
    {
        $this->loadModel('Iam.Policies');
        $this->loadModel('Iam.Roles');
    }

    public function getPolicyWithRoles(?int $id = null) : Policy
    {
        return $this->Policies->get($id, [
            'contain' => ['Roles']
        ]);
    }

    public function assignTo(int $roleId, Policy $policy)
    {
        $role = $this->Roles->get($roleId);

        return $this->Policies->Roles->link($policy, [$role]);
    }

    public function removeFrom(int $roleId, Policy $policy)
    {
        $role = $this->Roles->get($roleId);

        return $this->Policies->Roles->unlink($policy, [$role]);
    }
}