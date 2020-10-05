<?php

namespace Iam\Policy;

use Authorization\IdentityInterface;
use Authorization\Policy\Result;

class PolicyBuilderFormPolicy extends AppPolicy
{
    public function canAdd(IdentityInterface $user)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }
    }
}
