<?php
declare(strict_types=1);

namespace Iam\Service;

use Iam\Model\Entity\Policy;

interface PolicyManagerServiceInterface
{
    public function getPolicyWithRoles(?int $id = null) : Policy;

    public function assignTo(int $roleId, Policy $policy);

    public function removeFrom(int $roleId, Policy $policy);
}