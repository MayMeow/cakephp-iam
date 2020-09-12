<?php
declare(strict_types=1);

namespace Iam\Controller;

use Iam\Controller\AppController;

/**
 * Policies Controller
 *
 * @property \Iam\Model\Table\PoliciesTable $Policies
 * @method \Iam\Model\Entity\Policy[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PoliciesController extends AppController
{
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
}
