<?php
declare(strict_types=1);

namespace Iam\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Iam\Builder\PolicyBuilder;
use Iam\Controller\AppController;
use Iam\Form\AssignPolicyForm;
use Iam\Form\PolicyBuilderForm;

/**
 * Policies Controller
 *
 * @property \Iam\Model\Table\PoliciesTable $Policies
 * @property \Iam\Service\PolicyManagerServiceInterface $PolicyManager
 * @property \Iam\Service\RoleManagerServiceInterface $RoleManager
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
        $this->loadService('Iam.RoleManager');

        //$this->viewBuilder()->setTheme(Configure::read('Themes.backend'));
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
        $policy = $this->PolicyManager->getPolicyWithRoles((int)$id);

        $assignForm = new AssignPolicyForm();
        $roles = $this->RoleManager->getList();
        
        $this->set(compact('policy', 'assignForm', 'roles'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $policy = $this->Policies->newEmptyEntity();
        $policyForm = new PolicyBuilderForm();

        if ($this->request->is('post')) {

            $pb = new PolicyBuilder(
                $this->request->getData('prefix'),
                $this->request->getData('plugin'),
                $this->request->getData('controller'),
                $this->request->getData('action'));

            $policy->name = $pb->getName();
            $policy->description = $this->request->getData('description');

            if ($this->Policies->save($policy)) {
                $this->Flash->success(__('The policy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The policy could not be saved. Please, try again.'));
        }
        $this->set(compact('policyForm'));
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

    /**
     * Assign policy to role
     */
    public function assign($id = null)
    {
        $this->request->allowMethod(['post', 'patch', 'put']);
        $policy = $this->Policies->get($id);

        if ($this->PolicyManager->assignTo((int)$this->request->getData('role_id'), $policy)) {
            $this->Flash->success('OK');
        } else {
            $this->Flash->error('Something goes wrong');
        }

        return $this->redirect($this->referer());
    }

    /**
     * Revoke policy from role
     */
    public function revoke($id = null)
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
