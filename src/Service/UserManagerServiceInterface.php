<?php
declare(strict_types=1);

namespace Iam\Service;

use Authentication\IdentityInterface;
use Iam\Model\Entity\User;
use Iam\Model\Table\UsersTable;

interface UserManagerServiceInterface
{
    public function get(IdentityInterface $user) : User;

    public function getAll() : UsersTable;

    public function showOne($id, array $options =[]) : User;
}