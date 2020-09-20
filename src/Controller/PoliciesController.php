<?php
declare(strict_types=1);

namespace Iam\Controller;

use Cake\Event\EventInterface;
use Iam\Controller\AppController;
use Iam\Form\AssignPolicyForm;

/**
 * Policies Controller
 *
 * @property \Iam\Model\Table\PoliciesTable $Policies
 * @property \Iam\Service\PolicyManagerServiceInterface $PolicyManager
 * 
 * @method \Iam\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoliciesController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization();

        $this->loadService('Iam.PolicyManager');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $policies = $this->paginate($this->Policies);

        $this->set(compact('policies'));
    }

    /**
     * View method
     *
     * @param string|null $id Policy id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $policy = $this->Policies->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('policy'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $policy = $this->Policies->newEmptyEntity();
        if ($this->request->is('post')) {
            $policy = $this->Policies->patchEntity($policy, $this->request->getData());
            if ($this->Policies->save($policy)) {
                $this->Flash->success(__('The policy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The policy could not be saved. Please, try again.'));
        }
        $this->set(compact('policy'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Policy id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $policy = $this->Policies->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $policy = $this->Policies->patchEntity($policy, $this->request->getData());
            if ($this->Policies->save($policy)) {
                $this->Flash->success(__('The policy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The policy could not be saved. Please, try again.'));
        }
        $this->set(compact('policy'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Policy id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $policy = $this->Policies->get($id);
        if ($this->Policies->delete($policy)) {
            $this->Flash->success(__('The policy has been deleted.'));
        } else {
            $this->Flash->error(__('The policy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function assign($id = null)
    {
        $policy = $this->Policies->get($id, [
            'contain' => ['Roles']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if ($this->PolicyManager->assignTo((int)$this->request->getData('role_id'), $policy)) {
                $this->Flash->success('OK');
            } else {
                $this->Flash->error('Something goes wrong');
            }
        }

        $roles = $this->Policies->Roles->find('list');
        $assignForm = new AssignPolicyForm();

        $this->set(compact('policy', 'roles', 'assignForm'));
    }

    public function removeFrom($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $policy = $this->Policies->get($id);

        if ($this->PolicyManager->removeFrom((int)$this->request->getData('role_id'),$policy)) {
            $this->Flash->success('OK');
        } else {
            $this->Flash->error('Something goes wrong');
        }

        return $this->redirect($this->referer());
    }
}
