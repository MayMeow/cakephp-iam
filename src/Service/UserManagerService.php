<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Iam\Model\Entity\User;
use Iam\Model\Table\UsersTable;

/**
 * @property \Iam\Model\Table\UsersTable $Users
 */
class UserManagerService extends AppService
{
    public function initialize()
    {
        $this->loadModel('Iam.Users');
    }

    /**
     * Returns all users
     */
    public function getAll() : UsersTable
    {
        return $this->Users;
    }

    public function showOne($id, array $options =[]) : User
    {
        return $this->Users->get($id, $options);
    }
}