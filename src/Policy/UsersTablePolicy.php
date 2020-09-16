<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Iam\Model\Table\UsersTable;

/**
 * Users policy
 */
class UsersTablePolicy
{
    public function canIndex()
    {
        return true;
    }
}
