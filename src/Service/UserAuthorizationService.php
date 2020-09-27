<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Authentication\IdentityInterface;
use Iam\Builder\PolicyBuilderInterface;
use Iam\Builder\PolicyStringBuilderInterface;

/**
 * Class UserAuthorizationService
 * Authorizing users for requested actions
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

    /**
     * Method hasPolicyTo
     * 
     * Check if user has requested policy
     * @param \Iam\Builder\PolicyStringBuilderInterface $policy Normalized name of policy
     * @param \Authentication\IdentityInterface $user user object
     */
    public function hasPolicyTo(IdentityInterface $user, PolicyStringBuilderInterface $policy) : bool
    {
        $id = $user->getIdentifier();

        // Using Deep Query @mdm
        // That should give you all policies that match the given policy name and are associated with the roles of the given user
        $policies = $this->Policies
            ->find()
            ->matching('Roles.Users', function($q) use($id) {
                return $q->where(['Users.id' => $id]);
            })
            ->where(['Policies.normalized_name' => $policy->getNormalizedName()]);


        /*
        That should give you the user with the given ID in case it has at least one policy matching the given policy name associated with its roles.
        $userQuery = $this->Users
            ->find()
            ->matching('Roles.Policies', function($q) use($policy) {
                return $q->where(['Policies.normalized_name LIKE' => $policy]);
            })
            ->where([
                'Users.id' => $id,
            ]);
        */

        if (empty($policies->first())) {
            return false;
        }

        return true;
    }
}