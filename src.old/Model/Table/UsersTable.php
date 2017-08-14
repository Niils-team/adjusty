<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\HasMany $Calenders
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\HasMany $Plans
 * @property \Cake\ORM\Association\HasMany $Relationships
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('users');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Calenders', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Events', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Plans', [
            'foreignKey' => 'user_id'
        ]);
        $this->hasMany('Relationships', [
            'foreignKey' => 'user_id'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        // $validator
        //     ->integer('id')
        //     ->allowEmpty('id', 'create');
        //
        // $validator
        //     ->requirePresence('name', 'create')
        //     ->notEmpty('name');
        //
        // $validator
        //     ->email('email')
        //     ->requirePresence('email', 'create')
        //     ->notEmpty('email');
        //
        // $validator
        //     ->requirePresence('new_email', 'create')
        //     ->notEmpty('new_email');
        //
        // $validator
        //     ->requirePresence('company_name', 'create')
        //     ->notEmpty('company_name');
        //
        // $validator
        //     ->requirePresence('company_address', 'create')
        //     ->notEmpty('company_address');
        //
        // $validator
        //     ->requirePresence('company_dep', 'create')
        //     ->notEmpty('company_dep');
        //
        // $validator
        //     ->requirePresence('company_position', 'create')
        //     ->notEmpty('company_position');
        //
        // $validator
        //     ->requirePresence('company_url', 'create')
        //     ->notEmpty('company_url');
        //
        // $validator
        //     ->requirePresence('img_type1', 'create')
        //     ->notEmpty('img_type1');
        //
        // $validator
        //     ->requirePresence('img_data1', 'create')
        //     ->notEmpty('img_data1');
        //
        // $validator
        //     ->requirePresence('img_type2', 'create')
        //     ->notEmpty('img_type2');
        //
        // $validator
        //     ->requirePresence('img_data2', 'create')
        //     ->notEmpty('img_data2');
        //
        // $validator
        //     ->requirePresence('password', 'create')
        //     ->notEmpty('password');
        //
        // $validator
        //     ->integer('is_gcal')
        //     ->requirePresence('is_gcal', 'create')
        //     ->notEmpty('is_gcal');
        //
        // $validator
        //     ->requirePresence('gmail', 'create')
        //     ->notEmpty('gmail');
        //
        // $validator
        //     ->requirePresence('gcal', 'create')
        //     ->notEmpty('gcal');
        //
        // $validator
        //     ->requirePresence('activation_code', 'create')
        //     ->notEmpty('activation_code');
        //
        // $validator
        //     ->integer('is_mail')
        //     ->requirePresence('is_mail', 'create')
        //     ->notEmpty('is_mail');
        //
        // $validator
        //     ->integer('is_active')
        //     ->requirePresence('is_active', 'create')
        //     ->notEmpty('is_active');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
