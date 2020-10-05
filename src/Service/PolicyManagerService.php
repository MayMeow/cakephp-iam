<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Iam\Builder\PolicyStringBuilder;
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

    public function getList(): Query
    {
        return $this->Policies->find('list');
    }

    public function getPolicyWithRoles(int $id = null): Policy
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

    /**
     * @param ServerRequest $request
     * @return mixed
     */
    public function create(ServerRequest $request)
    {
        // if  action contains comma then split string into array of actions
        if (strpos($request->getData('action'), ',')) {
            $name = explode(',', $request->getData('action'));
        } else {
            $name = $request->getData('action');
        }

        if (is_array($name)) {
            // For each action in array create new policy
            foreach ($name as $policyAction) {
                $stringBuilder = new PolicyStringBuilder(
                    $request->getData('prefix'),
                    $request->getData('plugin'),
                    $request->getData('controller'),
                    $policyAction
                );

                $this->Policies->findOrCreate(
                    ['name' => $stringBuilder->getName()],
                    function ($entity) use ($stringBuilder, $request) {
                        $entity->name = $stringBuilder->getName();
                        $entity->description = $request->getData('description');
                    }
                );
            }
        } else {
            // Create single policy for given action
            $stringBuilder = new PolicyStringBuilder(
                $request->getData('prefix'),
                $request->getData('plugin'),
                $request->getData('controller'),
                $request->getData('action')
            );

            $this->Policies->findOrCreate(
                ['normalized_name' => $stringBuilder->getNormalizedName()],
                function ($entity) use ($stringBuilder, $request) {
                    $entity->name = $stringBuilder->getName();
                    $entity->description = $request->getData('description');
                }
            );
        }

        return true;
    }
}
