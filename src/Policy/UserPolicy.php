<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\ResultSet;
use Cake\ORM\TableRegistry;
use Iam\Model\Entity\User;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can create User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool
     */
    public function canCreate(IdentityInterface $user, User $resource)
    {
        return new Result(true);
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user);
    }

    /** 
     * @param \Authorization\IdentityInterface $user.
     */
    protected function isAdmin(IdentityInterface $user)
    {
        $userTable = TableRegistry::getTableLocator()->get('Iam.Users');

        /** @var \Iam\Model\Entity\User */
        $u = $userTable->get($user->getIdentifier());

        return $u->isAdmin;
    }
}
