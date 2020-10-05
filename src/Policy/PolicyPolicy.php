<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Iam\Model\Entity\Policy;

/**
 * Policy policy
 */
class PolicyPolicy extends AppPolicy
{
    /**
     * Check if $user can create Policy
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Policy $policy
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Policy $policy)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * Check if $user can update Policy
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Policy $policy
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Policy $policy)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * Check if $user can delete Policy
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Policy $policy
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Policy $policy)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * Check if $user can view Policy
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Policy $policy
     * @return bool
     */
    public function canView(IdentityInterface $user, Policy $policy)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * @param IdentityInterface $user
     * @param Policy $policy
     * @return Result|false
     */
    public function canAssign(IdentityInterface $user, Policy $policy)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * @param IdentityInterface $user
     * @param Policy $policy
     * @return Result|false
     */
    public function canRevok(IdentityInterface $user, Policy $policy)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }
}
