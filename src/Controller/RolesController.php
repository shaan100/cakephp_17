<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 * @method \App\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Permissions', 'Users'],
        ]);

        $this->set(compact('role'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        try {
            $role = $this->Roles->newEmptyEntity();
            $this->Authorization->authorize($role);
            if ($this->request->is('post')) {
                $role = $this->Roles->patchEntity($role, $this->request->getData());
                $collection = new Collection($role->permissions);
                $items = $collection->map(function ($value, $key) {
                    return ['_view' => $this->request->getData($value->permission_resource . '_view'), '_create' => $this->request->getData($value->permission_resource . '_create'), '_edit' => $this->request->getData($value->permission_resource . '_edit'), '_delete' => $this->request->getData($value->permission_resource . '_delete')];
                });
                foreach ($items as $key => $item) {
                    $role->permissions[$key]->_joinData = new Entity($item);
                }
                $role->user_id = $this->request->getAttribute('identity')->getIdentifier();
                //dd($role->user_id);
                if ($this->Roles->save($role)) {
                    $this->Flash->success(__('The role has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
            $permissions = $this->Roles->Permissions->find('all', ['limit' => 200])->all();
            $this->set(compact('role', 'permissions'));
        } catch (\Exception $e) {
            $this->Flash->error(__('You have not permissions!'));
            $this->redirect($this->request->referer());
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Permissions', 'RolesPermissions'],
        ]);
        $this->Authorization->authorize($role);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            $collection = new Collection($role->permissions);
            $items = $collection->map(function ($value, $key) {
                return ['_view' => $this->request->getData($value->permission_resource . '_view'), '_create' => $this->request->getData($value->permission_resource . '_create'), '_edit' => $this->request->getData($value->permission_resource . '_edit'), '_delete' => $this->request->getData($value->permission_resource . '_delete')];
            });
            foreach ($items as $key => $item) {
                $role->permissions[$key]->_joinData = new Entity($item);
            }
            $role->user_id = $this->request->getAttribute('identity')->getIdentifier();
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $permissions = $this->Roles->Permissions->find('all', ['limit' => 200])->all();
        $this->set(compact('role', 'permissions'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
