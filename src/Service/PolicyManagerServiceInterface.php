<?php
declare(strict_types=1);

namespace Iam\Service;

use Cake\ORM\Query;
use Iam\Model\Entity\Policy;

interface PolicyManagerServiceInterface
{
    public function getList() : Query;

    public function getPolicyWithRoles(int $id = null) : Policy;

    public function assignTo(int $roleId, Policy $policy);

    public function removeFrom(int $roleId, Policy $policy);
}