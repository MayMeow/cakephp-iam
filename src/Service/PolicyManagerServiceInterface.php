<?php
declare(strict_types=1);

namespace Iam\Service;

use Iam\Model\Entity\Policy;

interface PolicyManagerServiceInterface
{
    public function assignTo(int $roleId, Policy $policy);
}