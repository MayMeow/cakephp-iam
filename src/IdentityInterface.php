<?php

namespace Iam;

interface IdentityInterface
{
    public function getIsAdmin() : bool;

    public function getGroupIdentifier() : int;
}
