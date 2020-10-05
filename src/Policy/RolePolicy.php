<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Iam\Model\Entity\Role;

/**
 * Role policy
 */
class RolePolicy extends AppPolicy
{
    /**
     * Check if $user can create Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Role $role
     * @return bool
     */
    public function canCreate(IdentityInterface $user, Role $role)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * Check if $user can update Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Role $role
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, Role $role)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * Check if $user can delete Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Role $role
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Role $role)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * Check if $user can view Role
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\Role $role
     * @return bool
     */
    public function canView(IdentityInterface $user, Role $role)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * @param IdentityInterface $user
     * @param Role $role
     * @return Result|false
     */
    public function canAssign(IdentityInterface $user, Role $role)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }

    /**
     * @param IdentityInterface $user
     * @param Role $role
     * @return Result|false
     */
    public function canRevoke(IdentityInterface $user, Role $role)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }
}
