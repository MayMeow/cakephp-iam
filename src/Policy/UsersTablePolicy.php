<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\Identity;
use Authorization\IdentityInterface;
use Cake\ORM\Locator\LocatorAwareTrait;
use Iam\Model\Table\UsersTable;

/**
 * Users policy
 */
class UsersTablePolicy
{
    use LocatorAwareTrait;

    public function canIndex(IdentityInterface $user)
    {
        return $this->isAdmin($user);
    }

    protected function isAdmin(IdentityInterface $user)
    {
        $userTable = $this->getTableLocator()->get('Iam.Users');

        /** @var \Iam\Model\Entity\User */
        $u = $userTable->get($user->getIdentifier());

        return $u->isAdmin();
    }
}
