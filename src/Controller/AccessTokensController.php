<?php
declare(strict_types=1);

namespace Iam\Controller;

use Cake\Event\EventInterface;
use Cake\Utility\Security;
use Iam\Controller\AppController;

/**
 * AccessTokens Controller
 *
 * @property \Iam\Model\Table\AccessTokensTable $AccessTokens
 * 
 * @property \Iam\Service\AccessTokenManagerServiceInterface $AccessTokenManager
 * 
 * @method \Iam\Model\Entity\AccessToken[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccessTokensController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->Authorization->skipAuthorization();

        $this->loadService('Iam.AccessTokenManager');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $accessTokens = $this->paginate($this->AccessTokens);

        $this->set(compact('accessTokens'));
    }

    /**
     * View method
     *
     * @param string|null $id Access Token id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)    
    {
        $accessToken = $this->AccessTokens->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('accessToken'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $accessToken = $this->AccessTokens->newEmptyEntity();
        if ($this->request->is('post')) {
            if ($token = $this->AccessTokenManager->store($this->request, $this->Authentication->getIdentity())) {
                $this->Flash->success(__('Your token was generated: {0} Save it somewhere save because you cannot display it next time.', $token->token_plain));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The access token could not be saved. Please, try again.'));
        }
        $this->set(compact('accessToken'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Access Token id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $accessToken = $this->AccessTokens->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $accessToken = $this->AccessTokens->patchEntity($accessToken, $this->request->getData());
            if ($this->AccessTokens->save($accessToken)) {
                $this->Flash->success(__('The access token has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The access token could not be saved. Please, try again.'));
        }
        $users = $this->AccessTokens->Users->find('list', ['limit' => 200]);
        $this->set(compact('accessToken', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Access Token id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $accessToken = $this->AccessTokens->get($id);
        if ($this->AccessTokens->delete($accessToken)) {
            $this->Flash->success(__('The access token has been deleted.'));
        } else {
            $this->Flash->error(__('The access token could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
