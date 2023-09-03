<?php

declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\Table;
use Cake\I18n\FrozenTime;
use Cake\ORM\RulesChecker;
use Cake\Event\EventInterface;
use Cake\Validation\Validator;
use Sinergi\Token\StringGenerator;
use Cake\Datasource\EntityInterface;

/**
 * Users Model
 *
 * @property \App\Model\Table\ProfilesTable&\Cake\ORM\Association\HasMany $Profiles
 *
 * @method \App\Model\Entity\User newEmptyEntity()
 * @method \App\Model\Entity\User newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
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
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('userkeyid');

        $this->addBehavior('Timestamp');
        $this->hasOne('Profiles', [
            'dependent' => true,
            'cascadeCallbacks' => true
        ]);

        $this->hasMany('manyProfiles', [
            'className' => 'Profiles',
            'foreignKey' => 'user_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('username')
            ->maxLength('username', 255)
            ->allowEmptyString('username');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', __('Email Must be Required'));

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', __('Password Must be Required'));

        $validator
            ->scalar('token')
            ->maxLength('token', 255)
            ->allowEmptyString('token');

        $validator
            ->dateTime('token_expire')
            ->allowEmptyDateTime('token_expire');

        $validator
            ->dateTime('token_expiration')
            ->allowEmptyDateTime('token_expiration');

        $validator
            ->integer('userkeyid')
            ->allowEmptyString('userkeyid')
            ->add('userkeyid', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('api_token')
            ->maxLength('api_token', 255)
            ->allowEmptyString('api_token');

        $validator
            ->dateTime('activation_date')
            ->allowEmptyDateTime('activation_date');

        $validator
            ->numeric('longitude')
            ->allowEmptyString('longitude');

        $validator
            ->numeric('latitude')
            ->allowEmptyString('latitude');

        $validator
            ->notEmptyString('active');

        $validator
            ->dateTime('tos_date')
            ->allowEmptyDateTime('tos_date');

        $validator
            ->scalar('secret')
            ->maxLength('secret', 255)
            ->allowEmptyString('secret');

        $validator
            ->allowEmptyString('secret_verified');

        $validator
            ->scalar('account_verify')
            ->maxLength('account_verify', 255)
            ->allowEmptyString('account_verify');

        $validator
            ->allowEmptyString('is_superuser');

        $validator
            ->integer('role_id')
            ->allowEmptyString('role_id');

        $validator
            ->date('join_date')
            ->allowEmptyDate('join_date');

        $validator
            ->dateTime('login_time')
            ->allowEmptyDateTime('login_time');

        $validator
            ->dateTime('logout_time')
            ->allowEmptyDateTime('logout_time');

        $validator
            ->dateTime('trashed')
            ->allowEmptyDateTime('trashed');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username']), ['errorField' => 'username']);
        $rules->add($rules->isUnique(['email']), ['errorField' => 'email']);
        $rules->add($rules->isUnique(['userkeyid'], ['allowMultipleNulls' => true]), ['errorField' => 'userkeyid']);

        return $rules;
    }

    public function findAuthenticatedUser(\Cake\ORM\Query $query, array $options)
    {
        return $query->contain(['Profiles']);
    }

    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
    {
        if (!empty($data['dob'])) :
            $dob = new FrozenTime($data['dob']);
            $data['profile']['date_of_birth'] = $dob;
        endif;
        $data['join_date'] = FrozenTime::now();
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        if ($entity->isnew()) {
            // dd($entity);
            $entity->userkeyid = StringGenerator::randomNumeric(8);
            $entity->username  = $entity->profile->first_name . str_shuffle('_' . StringGenerator::randomAlnum(4)) . $entity->profile->last_name;
            $entity->role_id = 2;
        }
    }
}
