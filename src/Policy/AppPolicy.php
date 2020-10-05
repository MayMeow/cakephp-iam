<?php

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Burzum\CakeServiceLayer\Service\ServiceAwareTrait;
use Iam\Model\Entity\User;

/**
 * Class AppPolicy
 * @package Iam\Policy
 *
 * @property \Iam\Service\UserAuthorizationServiceInterface $UserAuthorization
 * @property \Iam\Service\UserManagerServiceInterface $UserManager
 *
 */
abstract class AppPolicy
{
    use ServiceAwareTrait;

    public function __construct()
    {
        $this->loadService('Iam.UserManager');
        $this->loadService('Iam.UserAuthorization');
    }

    /**
     * @param \Authorization\IdentityInterface|\Authentication\IdentityInterface $user.
     */
    protected function _getUser($user) : User
    {
        $u = $this->UserManager->get($user);

        return $u;
    }
}
