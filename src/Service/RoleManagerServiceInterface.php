<?php
declare(strict_types=1);

namespace Iam\Service;

use Cake\ORM\Query;
use Iam\Model\Entity\Role;

interface RoleManagerServiceInterface
{
    /**
     * @return Query
     */
    public function getList() : Query;

    /**
     * @param int|null $id
     * @return Role
     */
    public function getRoleWithUsers(int $id = null) : Role;

    /**
     * @param int $userId
     * @param Role $role
     * @return mixed
     */
    public function assignTo(int $userId, Role $role);

    /**
     * @param int $userId
     * @param Role $role
     * @return mixed
     */
    public function removeFrom(int $userId, Role $role);
}
