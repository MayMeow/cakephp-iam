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
use Iam\Model\Entity\User;

/**
 * User policy
 * 
 * @property \Iam\Service\UserManagerServiceInterface $UserManager
 * @property \Iam\Service\UserAuthorizationServiceInterface $UserAuthorization
 */
class UserPolicy
{
    use LocatorAwareTrait;
    use ServiceAwareTrait;

    public function __construct()
    {
        $this->loadService('Iam.UserManager');
        $this->loadService('Iam.UserAuthorization');
    }

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
        return $this->_getUser($user)->isAdmin();
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
        return $this->_getUser($user)->isAdmin();
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
        return $this->_getUser($user)->isAdmin();
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
        // TODO uncomment after DONE
        if ($this->_getUser($user)->isAdmin()) {
            //return true;
        }

        //dd($this->UserAuthorization->hasPolicyTo($this->_getUser($user), 'IAM/USERS:VIEW'));

        if ($this->UserAuthorization->hasPolicyTo($this->_getUser($user), 'IAM/USERS:VIEW')) {
            return true;
        }

        return false;
    }

    /** 
     * @param \Authorization\IdentityInterface $user.
     */
    protected function _getUser(IdentityInterface $user) : User
    {
        $u = $this->UserManager->get($user);

        return $u;
    }
}
