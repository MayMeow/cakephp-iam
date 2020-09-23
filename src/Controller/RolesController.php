<?php
declare(strict_types=1);

namespace Iam\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Iam\Controller\AppController;
use Iam\Form\AssignRoleForm;

/**
 * Roles Controller
 *
 * @property \Iam\Model\Table\RolesTable $Roles
 * @property \Iam\Service\RoleManagerServiceInterface $RoleManager
 * @property \Iam\Service\UserManagerServiceInterface $UserManager
 * 
 * @method \Iam\Model\Entity\Role[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RolesController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization();

        $this->loadService('Iam.RoleManager');
        $this->loadService('Iam.UserManager');

        $this->viewBuilder()->setTheme(Configure::read('Themes.backend'));
    }

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
        $role = $this->RoleManager->getRoleWithUsers((int)$id);

        $assignForm = new AssignRoleForm();
        $users = $this->UserManager->getList();

        $this->set(compact('role', 'assignForm', 'users'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEmptyEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
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
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->getData());
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The role could not be saved. Please, try again.'));
        }
        $this->set(compact('role'));
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

    public function assign($id = null)
    {
        $this->request->allowMethod(['post', 'put', 'patch']);
        $role = $this->Roles->get($id);

        if ($this->RoleManager->assignTo((int)$this->request->getData('user_id'), $role)) {
            $this->Flash->success('OK');
        } else {
            $this->Flash->error('Someting goes wrong');
        }

        return $this->redirect($this->referer());
    }

    public function revoke($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);

        if ($this->RoleManager->removeFrom((int)$this->request->getData('user_id'), $role))
        {
            $this->Flash->success('OK');
        } else {
            $this->Flash->error('Someting goes wrong');
        }

        return $this->redirect($this->referer());
    }
}
