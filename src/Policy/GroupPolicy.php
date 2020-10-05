<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Iam\Builder\PolicyBuilder;
use Iam\Model\Entity\Group;

/**
 * Group policy
 */
class GroupPolicy extends AppPolicy
{
    /**
     * Check if $user can create Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Group $group
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Group $group)
    {
        return false;
    }

    /**
     * @param IdentityInterface $user
     * @param Group $group
     * @return Result
     */
    public function canAdd(IdentityInterface $user, Group $group)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        if ($this->UserAuthorization->hasPolicyTo($this->_getUser($user), new PolicyBuilder(null, 'Iam', 'users', 'edit'))) {
            return new Result(true);
        }

        return new Result(false);
    }

    /**
     * Check if $user can update Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Group $group
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Group $group)
    {
        return false;
    }

    /**
     * Check if $user can delete Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Group $group
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Group $group)
    {
        return false;
    }

    /**
     * Check if $user can view Group
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Group $group
     * @return bool
     */
    public function canView(IdentityInterface $user, Group $group)
    {
        return false;
    }
}
