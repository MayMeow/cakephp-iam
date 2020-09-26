<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Cake\Http\ServerRequest;
use Authentication\IdentityInterface;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Query;
use Cake\Utility\Security;
use Iam\Model\Entity\AccessToken;

/**
 * @property \Iam\Model\Table\AccessTokensTable $AccessTokens
 */
class AccessTokenManagerService extends AppService implements AccessTokenManagerServiceInterface
{
    public function initialize()
    {
        parent::initialize();

        $this->loadModel('Iam.AccessTokens');
    }

    public function getAll() : Query
    {
        return $this->AccessTokens->find('all');
    }

    public function getAllForUser(IdentityInterface $user): Query
    {
        return $this->AccessTokens->find()->where(['Users.id' => $user->getIdentifier()])->contain(['Users']);
    }

    /**
     * Returns token with users that it belongs to
     */
    public function getTokenWithUser(int $id): AccessToken
    {
        return $this->AccessTokens->get($id, [
            'contain' => ['Users'],
        ]);
    }

    /**
     * Generate new token and store it to database
     */
    public function store(ServerRequest $request, IdentityInterface $user) : ?AccessToken
    {
        $at = $this->AccessTokens->newEmptyEntity();
        $at->user_id = $user->getIdentifier();

        $at->token_plain = Security::randomString(24);
        $at->token = (new DefaultPasswordHasher())->hash($at->token_plain);

        $at = $this->AccessTokens->patchEntity($at, $request->getData());

        return $this->AccessTokens->save($at);
    }
}