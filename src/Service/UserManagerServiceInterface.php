<?php
declare(strict_types=1);

namespace Iam\Service;

use Authentication\IdentityInterface;
use Cake\ORM\Query;
use Iam\Model\Entity\User;
use Iam\Model\Table\UsersTable;

interface UserManagerServiceInterface
{
    /**
     * @return Query
     */
    public function getList() : Query;

    /**
     * @param IdentityInterface $user
     * @return User
     */
    public function get(IdentityInterface $user) : User;

    /**
     * @return UsersTable
     */
    public function getAll() : UsersTable;

    /**
     * @param $id
     * @param array $options
     * @return User
     */
    public function showOne($id, array $options =[]) : User;
}
