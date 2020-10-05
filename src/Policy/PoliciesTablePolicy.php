<?php
declare(strict_types=1);

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;
use Iam\Model\Table\PoliciesTable;

/**
 * Rolicies policy
 */
class PoliciesTablePolicy extends AppPolicy
{
    /**
     * @param IdentityInterface $user
     * @return Result|bool
     */
    public function canIndex(IdentityInterface $user)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }

        return false;
    }
}
