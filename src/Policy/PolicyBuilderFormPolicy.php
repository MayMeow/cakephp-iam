<?php

namespace Iam\Policy;

use Authorization\Identity;
use Authorization\Policy\Result;

class PolicyBuilderFormPolicy extends AppPolicy
{
    public function canAdd(Identity $user)
    {
        if ($this->UserAuthorization->isAdministrator($user)) {
            return new Result(true);
        }
    }
}
