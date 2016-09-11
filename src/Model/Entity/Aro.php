<?php
namespace MyAcl\Model\Entity;

use Cake\ORM\Entity;

/**
 * Aro Entity
 *
 * @property int $id
 * @property int $parent_id
 * @property string $model
 * @property int $foreign_key
 * @property string $alias
 * @property int $lft
 * @property int $rght
 *
 * @property \App\Model\Entity\Aro $parent_aro
 * @property \App\Model\Entity\Aro[] $child_aros
 * @property \App\Model\Entity\Aco[] $acos
 */
class Aro extends Entity
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
        '*' => true,
        'id' => false
    ];
}
