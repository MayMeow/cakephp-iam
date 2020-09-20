<?php
declare(strict_types=1);

namespace Iam\Service;

use Iam\Model\Entity\Role;

interface RoleManagerServiceInterface
{
    public function assignTo(int $userId, Role $role);
    
    public function removeFrom(int $userId, Role $role);
}