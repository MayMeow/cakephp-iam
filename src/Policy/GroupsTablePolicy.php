<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Iam\Builder\PolicyStringBuilder;
use Iam\Model\Table\GroupsTable;

/**
 * Groups policy
 */
class GroupsTablePolicy extends AppPolicy
{
    /**
     * @param IdentityInterface $user
     * @return Result|bool
     */
    public function canIndex(IdentityInterface  $user)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        if ($this->UserAuthorization->hasPolicyTo($this->_getUser($user), new PolicyStringBuilder(null, 'Iam', 'groups', 'index'))) {
            return new Result(true);
        }

        return new Result(false);
    }
}
