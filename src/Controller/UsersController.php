<?php
declare(strict_types=1);

namespace Iam\Controller;

use Authorization\Exception\AuthorizationRequiredException;
use Authorization\Exception\ForbiddenException;
use Cake\Event\EventInterface;
use Iam\Controller\AppController;
use Iam\Model\Entity\User;

/**
 * Users Controller
 *
 * @property \Iam\Model\Table\UsersTable $Users
 * @method \Iam\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {        
        $allUsers = $this->Users;
        
        // $this->_CurrentUser()->can('index', $allUsers);
        //$this->Authorization->authorize($allUsers); // Uses UserTablePolicy
        //dd($this->request->getAttribute('identity')->can('index', $allUsers));

        $this->paginate = [
            'contain' => ['Groups'],
        ];
        $users = $this->paginate($allUsers);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Groups'],
        ]);

        //dd($this->request->getAttribute('identity')->can('view', $user));

        // Try Authorize user and if fails redirect back to referer and show flash message instead of stack trace
        try {
            $this->Authorization->authorize($user); // Uses UserEntityPolicy
        } catch (ForbiddenException $ex) {
            $this->Flash->error($ex->getMessage());

            return $this->redirect($this->referer());
        }

        $roles = $user->getPolicies();
        $isAdmin = $user->isAdmin;

        $this->set(compact('user', 'roles', 'isAdmin'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Authorization->skipAuthorization(); // Do not check if user is authorized

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        
        try {
            $this->Authorization->authorize($user); // Uses UserEntityPolicy
        } catch (ForbiddenException $ex) {
            $this->Flash->error($ex->getMessage());

            return $this->redirect($this->referer());
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $groups = $this->Users->Groups->find('list', ['limit' => 200]);
        $this->set(compact('user', 'groups'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        $this->Authorization->skipAuthorization();

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result->isValid()) {
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Users',
                'action' => 'index',
                'plugin' => 'Iam'
            ]);

            return $this->redirect($redirect);
        }

        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $this->Authorization->skipAuthorization();

        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    /**
     * Returns current authenticated user
     */
    private function _CurrentUser() : ?User
    {
        return $this->request->getAttribute('identity');
    }
}
