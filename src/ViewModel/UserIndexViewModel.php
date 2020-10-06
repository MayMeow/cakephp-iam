<?php
declare(strict_types=1);

namespace Iam\ViewModel;

use Authentication\IdentityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\I18n\FrozenTime;

class UserIndexViewModel
{
    protected int $id;
    protected string $email;
    protected int $groupId;
    protected string $groupName;
    protected bool $isActive;
    protected bool $isAdmin;
    protected FrozenTime $created;
    protected FrozenTime $modified;

    /**
     * UserIndexViewModel constructor.
     * @param int $id
     * @param string $email
     * @param int $groupId
     * @param string $groupName
     * @param bool $isActive
     * @param bool $isAdmin
     * @param FrozenTime $created
     * @param FrozenTime $modified
     */
    private function __construct(int $id, string $email, int $groupId, string $groupName, bool $isActive, bool $isAdmin, FrozenTime $created, FrozenTime $modified)
    {
        $this->id = $id;
        $this->email = $email;
        $this->groupId = $groupId;
        $this->groupName = $groupName;
        $this->isActive = $isActive;
        $this->isAdmin = $isAdmin;
        $this->created = $created;
        $this->modified = $modified;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return UserIndexViewModel
     */
    public function setId(int $id): UserIndexViewModel
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return UserIndexViewModel
     */
    public function setEmail(string $email): UserIndexViewModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return int
     */
    public function getGroupId(): int
    {
        return $this->groupId;
    }

    /**
     * @param int $groupId
     * @return UserIndexViewModel
     */
    public function setGroupId(int $groupId): UserIndexViewModel
    {
        $this->groupId = $groupId;
        return $this;
    }

    /**
     * @return string
     */
    public function getGroupName(): string
    {
        return $this->groupName;
    }

    /**
     * @param string $groupName
     * @return UserIndexViewModel
     */
    public function setGroupName(string $groupName): UserIndexViewModel
    {
        $this->groupName = $groupName;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return UserIndexViewModel
     */
    public function setIsActive(bool $isActive): UserIndexViewModel
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return FrozenTime
     */
    public function getCreated(): FrozenTime
    {
        return $this->created;
    }

    /**
     * @param FrozenTime $created
     * @return UserIndexViewModel
     */
    public function setCreated(FrozenTime $created): UserIndexViewModel
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return FrozenTime
     */
    public function getModified(): FrozenTime
    {
        return $this->modified;
    }

    /**
     * @param FrozenTime $modified
     * @return UserIndexViewModel
     */
    public function setModified(FrozenTime $modified): UserIndexViewModel
    {
        $this->modified = $modified;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    /**
     * @param bool $isAdmin
     * @return UserIndexViewModel
     */
    public function setIsAdmin(bool $isAdmin): UserIndexViewModel
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * Returns populated array f ViewModel
     *
     * @param \Cake\Datasource\ResultSetInterface|\Iam\Model\Entity\User[] $data
     * @param IdentityInterface $identity
     * @return array|\Iam\ViewModel\UserIndexViewModel[]
     */
    public static function prepare(ResultSetInterface $data, IdentityInterface $identity) : array
    {
        $model = [];

        foreach ($data as $user) {
            $active = $identity->getIdentifier() == $user->id;

            $model[] = new UserIndexViewModel(
                (int)$user->id,
                $user->email,
                $user->group_id,
                $user->group->name, $active, $user->is_admin, $user->created, $user->modified
            );
        }

        return $model;
    }
}
