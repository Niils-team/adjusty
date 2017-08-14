<?php
namespace App\Model\Entity;

namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher; //パスワード暗号化
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $new_email
 * @property string $company_name
 * @property string $company_address
 * @property string $company_dep
 * @property string $company_position
 * @property string $company_url
 * @property string $img_type1
 * @property string|resource $img_data1
 * @property string $img_type2
 * @property string|resource $img_data2
 * @property string $password
 * @property int $is_gcal
 * @property string $gmail
 * @property string $gcal
 * @property string $activation_code
 * @property int $is_mail
 * @property int $is_active
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Calender[] $calenders
 * @property \App\Model\Entity\Event[] $events
 * @property \App\Model\Entity\Plan[] $plans
 * @property \App\Model\Entity\Relationship[] $relationships
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
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * パスワードセッター passwordに値をセットするときハッシュ化する。
     * @param type $value
     * @return type
     */
    protected function _setPassword($value)
    {
      $hasher = new DefaultPasswordHasher();
      return $hasher->hash($value);
    }
}
