<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Authentication\IdentityInterface;
use Cake\ORM\Query;
use Iam\Model\Entity\User;
use Iam\Model\Table\UsersTable;

/**
 * @property \Iam\Model\Table\UsersTable $Users
 */
class UserManagerService extends AppService implements UserManagerServiceInterface
{
    public function initialize()
    {
        $this->loadModel('Iam.Users');
    }

    public function getList(): Query
    {
        return $this->Users->find('list');
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

    public function get(IdentityInterface $user) : User
    {
        return $this->Users->get($user->getIdentifier());
    }
}