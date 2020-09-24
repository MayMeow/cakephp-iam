<?php
declare(strict_types=1);

namespace Iam\Model\Entity;

use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * AccessToken Entity
 *
 * @property int $id
 * @property string $token
 * @property string $token_plain
 * @property bool $can_read
 * @property bool $can_write
 * @property \Cake\I18n\FrozenTime $created
 * @property int $user_id
 * @property string $description
 *
 * @property \Iam\Model\Entity\User $user
 */
class AccessToken extends Entity
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
        'token' => true,
        'token_plain' => true,
        'can_read' => true,
        'can_write' => true,
        'created' => true,
        'user_id' => true,
        'description' => true,
        'user' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'token',
    ];

    protected function _setToken(string $token_plain) : ?string
    {
        if (strlen($token_plain) > 0) {
            return (new DefaultPasswordHasher())->hash($token_plain);
        }
    }
}
