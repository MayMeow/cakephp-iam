<?php
declare(strict_types=1);

namespace Iam\Service;

use App\Service\AppService;
use Cake\Http\ServerRequest;
use Authentication\IdentityInterface;
use Authentication\PasswordHasher\DefaultPasswordHasher;
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