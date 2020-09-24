<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Iam\Model\Entity\AccessToken;

/**
 * AccessToken policy
 */
class AccessTokenPolicy
{
    /**
     * Check if $user can create AccessToken
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\AccessToken $accessToken
     * @return bool
     */
    public function canCreate(IdentityInterface $user, AccessToken $accessToken)
    {
    }

    /**
     * Check if $user can update AccessToken
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\AccessToken $accessToken
     * @return bool
     */
    public function canUpdate(IdentityInterface $user, AccessToken $accessToken)
    {
    }

    /**
     * Check if $user can delete AccessToken
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\AccessToken $accessToken
     * @return bool
     */
    public function canDelete(IdentityInterface $user, AccessToken $accessToken)
    {
    }

    /**
     * Check if $user can view AccessToken
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param Iam\Model\Entity\AccessToken $accessToken
     * @return bool
     */
    public function canView(IdentityInterface $user, AccessToken $accessToken)
    {
    }
}
