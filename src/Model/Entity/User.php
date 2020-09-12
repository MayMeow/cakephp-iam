<?php
declare(strict_types=1);

namespace Iam\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

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
 *
 * @property \Iam\Model\Entity\Group $group
 */
class User extends Entity
{
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
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password',
    ];

    // Returns all user policies
    public function getPolicies()
    {
        $id = $this->id;

        $rolesTable = TableRegistry::getTableLocator()->get('Iam.Roles');
        $policiesTable = TableRegistry::getTableLocator()->get('Iam.Policies');

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

    protected function _getIsAdmin() : bool
    {
        return true;
    }

    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
