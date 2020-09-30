<?php
declare(strict_types=1);

namespace Iam\Service;

use Cake\ORM\Query;
use Iam\Model\Entity\Policy;

interface PolicyManagerServiceInterface
{
    /**
     * @return Query
     */
    public function getList() : Query;

    /**
     * @param int|null $id
     * @return Policy
     */
    public function getPolicyWithRoles(int $id = null) : Policy;

    /**
     * @param int $roleId
     * @param Policy $policy
     * @return mixed
     */
    public function assignTo(int $roleId, Policy $policy);

    /**
     * @param int $roleId
     * @param Policy $policy
     * @return mixed
     */
    public function removeFrom(int $roleId, Policy $policy);
}
