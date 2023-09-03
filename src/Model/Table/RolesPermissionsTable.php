<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RolesPermissions Model
 *
 * @property \App\Model\Table\RolesTable&\Cake\ORM\Association\BelongsTo $Roles
 * @property \App\Model\Table\PermissionsTable&\Cake\ORM\Association\BelongsTo $Permissions
 *
 * @method \App\Model\Entity\RolesPermission newEmptyEntity()
 * @method \App\Model\Entity\RolesPermission newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\RolesPermission[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RolesPermission get($primaryKey, $options = [])
 * @method \App\Model\Entity\RolesPermission findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\RolesPermission patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RolesPermission[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RolesPermission|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RolesPermission saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RolesPermission[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RolesPermission[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\RolesPermission[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\RolesPermission[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RolesPermissionsTable extends Table
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

        $this->setTable('roles_permissions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
        ]);
        $this->belongsTo('Permissions', [
            'foreignKey' => 'permission_id',
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
            ->integer('role_id')
            ->allowEmptyString('role_id');

        $validator
            ->integer('permission_id')
            ->allowEmptyString('permission_id');

        $validator
            ->allowEmptyString('_view');

        $validator
            ->allowEmptyString('_create');

        $validator
            ->allowEmptyString('_edit');

        $validator
            ->allowEmptyString('_delete');

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
        $rules->add($rules->existsIn('role_id', 'Roles'), ['errorField' => 'role_id']);
        $rules->add($rules->existsIn('permission_id', 'Permissions'), ['errorField' => 'permission_id']);

        return $rules;
    }
}
