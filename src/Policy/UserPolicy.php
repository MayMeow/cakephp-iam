<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Burzum\CakeServiceLayer\Service\ServiceAwareTrait;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\Locator\TableLocator;
use Cake\ORM\ResultSet;
use Cake\ORM\TableRegistry;
use Iam\Builder\PolicyBuilder;
use Iam\Model\Entity\User;

/**
 * User policy
 *
 * @property \Iam\Service\UserManagerServiceInterface $UserManager
 * @property \Iam\Service\UserAuthorizationServiceInterface $UserAuthorization
 */
class UserPolicy extends AppPolicy
{
    /**
     * Check if $user can create User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool|\Authorization\Policy\Result
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
        if ($this->UserAuthorization->isAdministrator($user)) {
            return true;
        }

        return false;
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool|\Authorization\Policy\Result
     */
    public function canEdit(IdentityInterface $user, User $resource)
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
     * Check if $user can delete User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return true;
        }

        return false;
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\User $resource
     * @return bool|\Authorization\Policy\Result
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        // TODO uncomment after DONE
        if ($this->UserAuthorization->isAdministrator($user)) {
            return true;
        }

        if ($this->UserAuthorization->hasPolicyTo($this->_getUser($user), new PolicyBuilder(null, 'Iam', 'users', 'view'))) {
            return new Result(true);
        }

        return new Result(false);
    }
}
