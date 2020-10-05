<?php
declare(strict_types=1);

namespace Iam\Model\Entity;

use ArrayAccess;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authorization\AuthorizationServiceInterface;
use Authorization\IdentityInterface as AuthorizationIdentity;
use Authentication\IdentityInterface as Authenticationidentity;
use Authorization\Policy\ResultInterface;
use Cake\ORM\Entity;
use Cake\ORM\Locator\LocatorAwareTrait;
use Cake\ORM\TableRegistry;
use Iam\IdentityInterface as IamIdentity;
use phpDocumentor\Reflection\Types\This;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $api_key
 * @property string $api_key_plain
 * @property int $group_id
 * @property boolean $is_admin
 *
 * @property \Iam\Model\Entity\Group $group
 */
class User extends Entity implements AuthorizationIdentity, Authenticationidentity, IamIdentity
{
    use LocatorAwareTrait;

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'email' => true,
        'password' => true,
        'created' => true,
        'modified' => true,
        'api_key' => true,
        'api_key_plain' => true,
        'group_id' => true,
        'group' => true,
        'is_admin' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    /**
     * Authentication\IdentityInterface method
     */
    public function getIdentifier()
    {
        return $this->id;
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function can($action, $resource) : bool
    {
        return $this->authorization->can($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function canResult($action, $resource): ResultInterface
    {
        return $this->authorization->canResult($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function applyScope($action, $resource)
    {
        return $this->authorization->applyScope($this, $action, $resource);
    }

    /**
     * Authorization\IdentityInterface method
     */
    public function getOriginalData()
    {
        return $this;
    }

    /**
     * Setter to be used by the middleware.
     */
    public function setAuthorization(AuthorizationServiceInterface $service)
    {
        $this->authorization = $service;

        return $this;
    }

    // Returns all user's policies
    public function getPolicies()
    {
        $id = $this->id;

        $rolesTable = $this->getTableLocator()->get('Iam.Roles');
        $policiesTable = $this->getTableLocator()->get('Iam.Policies');

        // Find all users roles
        $roles = $rolesTable->find('list')->select(['Roles.id'])
            ->matching('Users', function($q) use($id) {
                return $q->where(['Users.id' => $id]);
            })->toArray();

        // Find all users policies matching roles
        $policies = $policiesTable->find()
            ->matching('Roles', function($q) use ($roles) {
                return $q->where(['Roles.id IN' => array_keys($roles)]);
            });

        return $policies;
    }

    public function hasPolicyTo(string $policy)
    {
        $id = $this->id;

        $rolesTable = $this->getTableLocator()->get('Iam.Roles');
        $policiesTable = $this->getTableLocator()->get('Iam.Policies');

        // Find all users roles
        $roles = $rolesTable->find('list')->select(['Roles.id'])
            ->matching('Users', function($q) use($id) {
                return $q->where(['Users.id' => $id]);
            })->toArray();

        if (empty($roles)) {
            return false;
        }

        // Find all users policies matching roles
        $policies = $policiesTable->find()
            ->matching('Roles', function($q) use ($roles) {
                return $q->where(['Roles.id IN' => array_keys($roles)]);
            });

        return $policies;
    }

    /**
     * @return bool
     * @deprecated
     */
    public function isAdmin() : bool
    {
        // Check if user is super admin
        if ($this->is_admin == true) {
            return true;
        }

        $groupsTable = $this->getTableLocator()->get('Iam.Groups');

        /** @var \Iam\Model\Entity\Group */
        $group = $groupsTable->get($this->group_id);

        if ($group->normalized_name == 'ADMINISTRATORS') {
            return true;
        }

        return false;
    }

    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }

    /**
     * @return bool
     */
    public function getIsAdmin(): bool
    {
        if ($this->is_admin) {
            return true;
        }

        return  false;
    }

    /**
     * @return int
     */
    public function getGroupIdentifier(): int
    {
        return $this->group_id;
    }
}
