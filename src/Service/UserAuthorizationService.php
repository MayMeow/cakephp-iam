<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Authentication\IdentityInterface;

/**
 * 
 * @property \Iam\Model\Table\PoliciesTable $Policies
 * @property \Iam\Model\Table\PoliciesRolesTable $Roles
 */
class UserAuthorizationService extends AppService implements UserAuthorizationServiceInterface
{
    public function initialize()
    {
        $this->loadModel('Iam.Roles');
        $this->loadModel('Iam.Policies');
    }

    public function hasPolicyTo(IdentityInterface $user, string $policy) : bool
    {
        $id = $user->getIdentifier();

        $roles = $this->Roles->find('list')->select(['Roles.id'])
            ->matching('Users', function($q) use($id) {
                return $q->where(['Users.id' => $id]);
            })->toArray();
        
        if (empty($roles)) {
            return false;
        }

        $policies = $this->Policies->find('all')
            ->matching('Roles', function ($q) use ($roles) {
                return $q->where(['Roles.id IN' => array_keys($roles)]);
            })->where(['Policies.name LIKE' => $policy]);

        if (empty($policies)) {
            return false;
        }

        return true;
    }
}