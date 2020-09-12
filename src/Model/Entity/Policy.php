<?php
declare(strict_types=1);

namespace Iam\Model\Entity;

use Cake\ORM\Entity;

/**
 * Policy Entity
 *
 * @property int $id
 * @property string $name
 * @property string $normalized_name
 * @property string $description
 */
class Policy extends Entity
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
        'name' => true,
        'normalized_name' => true,
        'description' => true,
    ];
}
